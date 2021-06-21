<?php

namespace Tests\Feature;

use App\Http\Controllers\InspectorController;
use App\Http\Controllers\ListController;
use App\Http\Requests\ListRequest;
use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\StoreListValueRequest;
use App\Http\Requests\UpdateInspectorRequest;
use App\Models\ListModel;
use App\Models\ListValue;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ListCRUDTest extends TestCase
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
    }

    public function test_create_screen_can_be_rendered()
    {
        $response = $this->get('/list/create');

        $response->assertStatus(200);
    }

    public function test_new_list_can_be_created()
    {
        ListModel::create([
            'name' => 'test',
            'list_model_id' => null
        ]);
        $lists = ListModel::all();
        $oldList = $lists[count($lists)-1];
        $controller = new ListController();
        $controller->store(new ListRequest([
            'name' => 'test_list',
            'list_model_id' => 1
        ]));

        $lists = ListModel::all();
        $newlist = $lists[count($lists)-1];
        $this->assertFalse($oldList->is($newlist));
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
