<?php

namespace Tests\Feature;

use App\Http\Controllers\InspectorController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TemplateController;
use App\Http\Requests\ListRequest;
use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\StoreListValueRequest;
use App\Http\Requests\StoreTemplateRequest;
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

        $icon = Icon::create([
            'name' => 'fire-extinguisher',
            'unicode' => 'f134'
        ]);
        $this->inspection_type = InspectionType::create([
            'icon_id' => $icon->id,
            'name' => 'Brandblussers',
            'description' => 'Alle brandblussers moeten niet over de datum zijn.',
            'color' => '#FF3333'
        ]);
    }

    public function test_index_screen_can_be_rendered()
    {
        $response = $this->get('/template');

        $response->assertStatus(200);
    }

    public function test_template_choose_version_screen_can_be_rendered()
    {
        Template::create([
            'inspection_type_id' => $this->inspection_type->id,
            'json' => '[]',
        ]);
        $response = $this->get('/template/'.$this->inspection_type->id.'/versions');

        $response->assertStatus(200);
    }


    public function test_create_screen_can_be_rendered()
    {
        $response = $this->get('/template/create');

        $response->assertStatus(200);
    }

    public function test_new_template_can_be_created()
    {
        Template::create([
            'inspection_type_id' => $this->inspection_type->id,
            'json' => '[]',
        ]);
        $templates = Template::all();
        $oldTemplate = $templates[count($templates)-1];
        $controller = new TemplateController();
        $controller->store(new StoreTemplateRequest([
            'type_id' => $this->inspection_type->id
        ]));

        $templates = Template::all();
        $newTemplate = $templates[count($templates)-1];
        $this->assertFalse($oldTemplate->is($newTemplate));
    }

    public function test_edit_screen_can_be_rendered()
    {
        $template = Template::create([
            'inspection_type_id' => $this->inspection_type->id,
            'json' => '[]',
        ]);
        $response = $this->get('/template/'.$template->id.'/edit');

        $response->assertStatus(200);
    }
}
