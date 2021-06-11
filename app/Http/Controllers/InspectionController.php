<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Inspection;
use App\Models\Customer;
use App\Models\InspectionType;
use App\Models\ListModel;
use App\Models\Location;
use App\Models\Inspector;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InspectionController extends Controller
{
    public function index($customer_id, $location_id)
    {
        $inspections = Inspection::query()->where('customer_id', '=', $customer_id)
            ->where('location_id', '=', $location_id)->get()->sortByDesc("created_at");
        $inspectionTypes = InspectionType::all();
        $users = User::all();

        return view('inspection.index', [
            'inspections' => $inspections,
            'inspectionTypes' => $inspectionTypes,
            "users" => $users
        ]);
    }

    public function choose_template($customer_id, $location_id)
    {
        $inspection_type_ids = Template::distinct()->get("inspection_type_id");

        $templates = array();

        foreach ($inspection_type_ids as $inspection_type_id) {
            $template = Template::all()->where('inspection_type_id', $inspection_type_id->inspection_type_id)->sortByDesc('created_at')->first();
            array_push($templates, $template);
        }

        return view('inspection.choose_template', [
            'templates' => $templates,
            'location' => Location::find($location_id),
            'customer_id' => $customer_id
        ]);
    }

    public function create($customer_id, $location_id, $template_id)
    {
        $user_id = Auth::id();
        $inspection = Inspection::create([
            'user_id' => $user_id,
            'customer_id' => $customer_id,
            'location_id' => $location_id,
            'template_id' => $template_id,
            "json" => "",
            "locked" => $user_id,
        ]);

        return redirect()->to("inspection/inspect/" . $inspection->id . "/" . $template_id . '/' . "create");
    }

    public function exit($inspection_id, $customer_id)
    {
        $inspection = Inspection::find($inspection_id);

        $inspection->locked = null;

        $inspection->save();

        return redirect()->to("inspection/" . $customer_id . "/" . $inspection->location_id);
    }

    public function inspect($id, $template_id, $type)
    {
        $template = Template::find($template_id);
        $template->json = json_decode($template->json);
        $inspection = Inspection::find($id);
        $inspection_types = InspectionType::all();
        $user = User::find($inspection->user_id);

        $lists = [];
        foreach (ListModel::all() as $list) {
            $lists[$list->id] = (object)['name' => $list->name, 'values' => []];
            foreach ($list->values()->get() as $value) {
                $valueLink = [(object)['id' => $value->model()->id, 'name' => $value->model()->name, 'value' => $value->name]];
                while ($value->linked_value() != null) {
                    $value = $value->linked_value();
                    array_push($valueLink, (object)['id' => $value->model()->id, 'name' => $value->model()->name, 'value' => $value->name]);
                }
                array_push($lists[$list->id]->values, array_reverse($valueLink));
            }
        }
        $lists = (object)$lists;

        //check if inspection is not locked, or is locked by this inspector
        if (($inspection->locked == null || $inspection->locked == Auth::id())) {
            $inspection->locked = Auth::id();
            $inspection->save();

            if ($type == "create") {
                return view('inspection.create', [
                    "id" => $id,
                    'template' => $template,
                    "inspection" => $inspection,
                    "user" => $user,
                    'inspection_types' => $inspection_types,
                    'lists' => $lists
                ]);
            } else if ($type == "edit") {
                $inspectors = User::whereHas(
                    'roles', function ($q) {
                    $q->where('name', 'inspecteur')->orWhere('name', 'admin');;
                }
                )->get();
                return view('inspection.edit', [
                    "id" => $id,
                    'template' => $template,
                    "inspection" => $inspection,
                    "user" => $user,
                    'inspection_types' => $inspection_types,
                    'lists' => $lists,
                    'inspectors' => $inspectors
                ]);
            }
        } else {
            $locked_user = User::find($inspection->locked);
            return view('inspection.view', [
                "id" => $id,
                'template' => $template,
                "inspection" => $inspection,
                "user" => $user,
                'lists' => $lists,
                "locked_username" => $locked_user->first_name,
            ]);
        }
    }


    public function save(Request $request, $id)
    {
        $payload = json_decode($request->getContent(), true);

        $inspection = Inspection::find($id);

        $inspection->json = $payload["json"];

        $inspection->save();

        return response()->json(
            [
                'status' => '200',
                'success' => 'true'
            ],
            200
        );
    }

    public function edit($id)
    {
        $inspection = Inspection::find($id);
        return redirect()->to("inspection/inspect/" . $inspection->id . "/" . $inspection->template_id . '/' . "edit");
    }

    public function update($id, UpdateCustomerRequest $request)
    {
        $inspection = Inspection::find($id);

        return response()->json(
            [
                'status' => '200',
                'success' => 'true'
            ],
            200
        );
    }

    public function updateInspector($id, Request $request)
    {
        $inspection = Inspection::find($id);

        $inspection->user_id = $request->input('inspector');

        $inspection->save();

        return redirect()->back();
    }


    public function remove($id)
    {
        $inspection = Inspection::find($id);
        if ($inspection === null) {
            abort(404, 'customer with that ID does not exist');
        }
        return view('admin.inspection.archive', [
            'inspection' => $inspection,
            'id' => $id
        ]);
    }

    public function archive($id)
    {
        $inspection = Inspection::find($id);
        $inspection->delete();
        return redirect(route('getLocationIndex'));
    }
}
