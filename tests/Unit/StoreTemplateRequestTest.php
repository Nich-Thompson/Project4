<?php

namespace Tests\Unit;

use App\Http\Requests\StoreTemplateRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreTemplateRequestTest extends TestCase
{
    public function test_it_should_contain_all_the_expected_validation_rules()
    {
        $request = new StoreTemplateRequest();

        $this->assertEquals([
            'labels.*' => 'required'
        ], $request->rules());
    }

    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid_data(array $data)
    {
        $request = new StoreTemplateRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        return [
            [[
                'labels' => [],
            ]],
            [[
                'labels' => ['label1', 'label2'],
            ]]
        ];
    }

    /**
     * @dataProvider provideInvalidData
     *
     */
    public function test_invalid_data(array $data)
    {
        $request = new StoreTemplateRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidData(): array
    {
        return [
            [[
                'labels' => ['label1', null], //missing label
            ]]
        ];
    }
}
