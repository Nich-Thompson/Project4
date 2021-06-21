<?php

namespace Tests\Unit;

use App\Http\Requests\ListRequest;
use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\StoreListValueRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class ListRequestTest extends TestCase
{
    public function test_it_should_contain_all_the_expected_validation_rules()
    {
        $request = new ListRequest();

        $this->assertEquals([
            'name' => 'required|max:80'
        ], $request->rules());
    }

    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid_data(array $data)
    {
        $request = new ListRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        return [
            [[
                'name' => 'a',
            ]],
            [[
                'name' => str_repeat('a', 80),
            ]],
        ];
    }

    /**
     * @dataProvider provideInvalidData
     *
     */
    public function test_invalid_data(array $data)
    {
        $request = new ListRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidData(): array
    {
        return [
            [[]],//missing fields
            [[
                'name' => null, //missing name
            ]],
            [[
                'name' => str_repeat('a', 81),//name too long
            ]]
        ];
    }
}
