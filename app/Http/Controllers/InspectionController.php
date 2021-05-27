<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Inspection;
use App\Models\Customer;
use App\Models\InspectionType;
use App\Models\Location;
use App\Models\Inspector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class inspectionController extends Controller
{
    public function index($Customer_id)
    {
        $customer_id = $Customer_id;
        $inspections = Inspection::query()->where('customer_id', '=', $customer_id)->get();
        $inspectionTypes = InspectionType::all();
        return view('inspection.index', [
            'inspections' => $inspections,
            'inspectionTypes' => $inspectionTypes,
        ]);
    }

    public function create($Customer_id, $Location_id)
    {
        $user_id = Auth::id();
        $customer_id = $Customer_id;
        $location_id = $Location_id;
        $inspection = Inspection::create([
            'user_id' => $user_id,
            'customer_id' => $customer_id,
            'location_id' => $location_id,
            "json" => "",
            "locked" => $user_id,
        ]);

        return redirect()->to("inspection/inspect/" . $inspection->id . "/" . "create");
    }

    public function exit($inspection_id, $customer_id)
    {
        $inspection = Inspection::find($inspection_id);

        $inspection->locked = null;

        $inspection->save();

        return redirect()->to("inspection/" . $customer_id);
    }

    public function inspect($id, $type)
    {
        $inspection = Inspection::find($id);
        $inspection_types = InspectionType::all();
        $user = User::find($inspection->user_id);

        //check if inspection is not locked, or is locked by this inspector
        if ($inspection->locked == null || $inspection->locked == Auth::id()) {
            $inspection->locked = Auth::id();
            $inspection->save();

            if ($type == "create") {
                return view('inspection.create', [
                    "id" => $id,
                    "inspection" => $inspection,
                    "username" => $user->name,
                    'inspection_types' => $inspection_types,
                ]);
            } else if ($type == "edit") {
                $inspectors = User::whereHas(
                    'roles', function ($q) {
                    $q->where('name', 'inspecteur')->orWhere('name', 'admin');;
                }
                )->get();
                return view('inspection.edit', [
                    "id" => $id,
                    "inspection" => $inspection,
                    "username" => $user->name,
                    'inspection_types' => $inspection_types,
                    'inspectors' => $inspectors
                ]);
            }
        } else {
            $locked_user = User::find($inspection->locked);
            return view('inspection.view', [
                "id" => $id,
                "inspection" => $inspection,
                "username" => $user->name,
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
        return redirect()->to("inspection/inspect/" . $inspection->id . "/" . "edit");
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

        return redirect()->to("inspection/inspect/" . $inspection->id . "/" . "edit");
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
