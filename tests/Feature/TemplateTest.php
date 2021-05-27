<?php

namespace Tests\Feature;

use App\Http\Controllers\InspectorController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TemplateController;
use App\Http\Requests\ListRequest;
use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\StoreListValueRequest;
use App\Http\Requests\UpdateInspectorRequest;
use App\Models\Icon;
use App\Models\InspectionType;
use App\Models\ListModel;
use App\Models\ListValue;
use App\Models\Role;
use App\Models\Template;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TemplateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        \Spatie\Permission\Models\Role::create(["name" => "admin"]);
        \Spatie\Permission\Models\Role::create(["name" => "inspecteur"]);
        $user-> assignRole('admin');

        $this->be($user);

        Icon::create([
            'name' => 'fire-extinguisher',
            'unicode' => 'f134'
        ]);
        InspectionType::create([
            'icon_id' => 1,
            'name' => 'Brandblussers',
            'description' => 'Alle brandblussers moeten niet over de datum zijn.',
            'color' => '#FF3333'
        ]);
    }

    public function test_create_screen_can_be_rendered()
    {
        $response = $this->get('/template/create');

        $response->assertStatus(200);
    }

    public function test_new_template_can_be_created()
    {
        Template::create([
            'inspection_type_id' => 1,
            'json' => '[]',
        ]);
        $templates = Template::all();
        $oldTemplate = $templates[count($templates)-1];
        $controller = new TemplateController();
        $controller->store(new Request([
            'type_id' => 1
        ]));

        $templates = Template::all();
        $newTemplate = $templates[count($templates)-1];
        $this->assertFalse($oldTemplate->is($newTemplate));
    }

    public function test_edit_screen_can_be_rendered()
    {
        $list = ListModel::create([
            'name' => 'test',
            'list_model_id' => null
        ]);
        $response = $this->get('/list/'.$list->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_list_can_be_edited()
    {
        $oldList = ListModel::create([
            'name' => 'test_list',
            'list_model_id' => null
        ]);

        $controller = new ListController();
        $controller->update($oldList->id, new ListRequest([
            'name' => 'test_list_1'
        ]));

        $newList = ListModel::find($oldList->id);

        $this->assertFalse($oldList->name === $newList->name);
    }

    public function test_createValue_screen_can_be_rendered()
    {
        $list = ListModel::create([
            'name' => 'test',
            'list_model_id' => null
        ]);
        $response = $this->get('/list/'.$list->id.'/create-value');

        $response->assertStatus(200);
    }

    public function test_new_listValue_can_be_created()
    {
        $list = ListModel::create([
            'name' => 'test',
            'list_model_id' => null
        ]);
        $listValue = ListValue::create([
            'name' => 'test',
            'list_model_id' => $list->id,
            'list_value_id' => null
        ]);
        $listValues = ListValue::all();
        $oldValue = $listValues[count($listValues)-1];
        $controller = new ListController();
        $controller->storeValue(new StoreListValueRequest([
            'name' => 'test_value_2',
            'sublist_value' => null
        ]), $list->id);

        $listValues = ListValue::all();
        $newValue = $listValues[count($listValues)-1];
        $this->assertFalse($oldValue->is($newValue));
    }

    public function test_editValue_screen_can_be_rendered()
    {
        $list = ListModel::create([
            'name' => 'test',
            'list_model_id' => null
        ]);
        $listValue = ListValue::create([
            'name' => 'test',
            'list_model_id' => $list->id,
            'list_value_id' => null
        ]);
        $response = $this->get('/list/'.$list->id.'/'.$listValue->id.'/edit-value');

        $response->assertStatus(200);
    }

    public function test_listValue_can_be_edited()
    {
        $list = ListModel::create([
            'name' => 'test',
            'list_model_id' => null
        ]);
        $oldValue = ListValue::create([
            'name' => 'test_value_2',
            'list_model_id' => $list->id,
            'list_value_id' => null
        ]);

        $controller = new ListController();
        $controller->updateValue(new StoreListValueRequest([
            'name' => 'test_list',
            'sublist_value' => null
        ]),1, $oldValue->id);

        $newValue = ListValue::find($oldValue->id);

        $this->assertFalse($oldValue->name === $newValue->name);
        $this->assertTrue($oldValue->list_value_id === $newValue->list_value_id);
    }
}
