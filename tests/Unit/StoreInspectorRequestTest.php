<?php

namespace Tests\Unit;

use App\Http\Requests\StoreInspectorRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class StoreInspectorRequestTest extends TestCase
{
    public function test_it_should_contain_all_the_expected_validation_rules()
    {
        $request = new StoreInspectorRequest();

        $this->assertEquals([
            'email' => 'required|max:80',
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'phone_number' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation|min:6|max:45',
        ], $request->rules());
    }

    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid_data(array $data)
    {
        $request = new StoreInspectorRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'email' => 'test@email.com',
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => $faker -> email,
                'first_name' => $faker -> firstName,
                'last_name' => $faker -> lastName,
                'phone_number' => $faker -> phoneNumber,
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
        ];
    }

    /**
     * @dataProvider provideInvalidData
     *
     */
    public function test_invalid_data(array $data)
    {
        $request = new StoreInspectorRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[]],//missing fields
            [[
                'first_name' => 'test first name', //missing email
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com',//missing first name
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com', //missing last name
                'first_name' => 'test first name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com', //missing phone number
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com', //missing password
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com',//missing password confirmation
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password'
            ]],
            [[
                'email' =>  str_repeat('a', 81), //email too long
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' =>  'test@email.com', //first name too long
                'first_name' => str_repeat('a', 81),
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com', //last name too long
                'first_name' => 'test first name',
                'last_name' => str_repeat('a', 81),
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'password'
            ]],
            [[
                'email' => 'test@email.com', //password confirmation failed
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'password',
                'password_confirmation' => 'pasord'
            ]],
            [[
                'email' => 'test@email.com', //password too short
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => 'pass',
                'password_confirmation' => 'pass'
            ]],
            [[
                'email' => 'test@email.com', //password too long
                'first_name' => 'test first name',
                'last_name' => 'test last name',
                'phone_number' => '06489348343',
                'password' => str_repeat('a', 46),
                'password_confirmation' => str_repeat('a', 46)
            ]]
        ];
    }
}
