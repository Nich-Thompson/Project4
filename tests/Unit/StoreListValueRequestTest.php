<?php

namespace Tests\Unit;

use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\StoreListValueRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class StoreListValueRequestTest extends TestCase
{
    public function test_it_should_contain_all_the_expected_validation_rules()
    {
        $request = new StoreListValueRequest();

        $this->assertEquals([
            'name' => 'required|max:20'
        ], $request->rules());
    }

    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid_data(array $data)
    {
        $request = new StoreListValueRequest();

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
                'name' => str_repeat('a', 20),
            ]],
        ];
    }

    /**
     * @dataProvider provideInvalidData
     *
     */
    public function test_invalid_data(array $data)
    {
        $request = new StoreListValueRequest();

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
                'name' => str_repeat('a', 21),//name too long
            ]]
        ];
    }
}
