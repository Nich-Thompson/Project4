<?php

namespace Tests\Feature;

use App\Http\Controllers\InspectorController;
use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\UpdateInspectorRequest;
use App\Models\Role;
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

class InspectorCRUDTest extends TestCase
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
        $response = $this->get('/inspector/create');

        $response->assertStatus(200);
    }

    public function test_new_inspector_can_be_created()
    {
        $users = User::all();
        $oldUser = $users[count($users)-1];
        $controller = new InspectorController();
        $controller->store(new StoreInspectorRequest([
            'name' => 'Inspector',
            'first_name' => 'Eric',
            'last_name' => 'Andre',
            'phone_number' => '0634983985',
            'email' => 'user2@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]));

        $users = User::all();
        $newUser = $users[count($users)-1];
        $this->assertFalse($oldUser->is($newUser));
    }

    public function test_edit_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->get('/inspector/'.$user->id.'/edit');

        $response->assertStatus(200);
    }

    public function test_inspector_can_be_edited()
    {
        $oldUser = User::factory()->create();

        $controller = new InspectorController();
        $controller->update($oldUser->id, new UpdateInspectorRequest([
            'first_name' => 'NotAPossibleName',
            'last_name' => $oldUser->last_name,
            'phone_number' => $oldUser->phone_number,
            'email' => $oldUser->email
        ]));

        $newUser = User::find($oldUser->id);

        $this->assertTrue($oldUser->last_name === $newUser->last_name);
        $this->assertFalse($oldUser->first_name === $newUser->first_name);
    }

    public function test_archive_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->get('/inspector/'.$user->id.'/archive');

        $response->assertStatus(200);
    }

    public function test_inspector_can_be_archived()
    {
        //this function hasnt been made yet
        $this->assertTrue(true);
    }
}
