<?php

namespace Tests\Unit;

use App\Http\Requests\StoreInspectorRequest;
use App\Http\Requests\StoreLocationRequest;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class StoreLocationRequestTest extends TestCase
{
    public function test_it_should_contain_all_the_expected_validation_rules()
    {
        $request = new StoreLocationRequest();

        $this->assertEquals([
            'name' => 'required',
        ], $request->rules());
    }

    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid_data(array $data)
    {
        $request = new StoreLocationRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'name' => 'Avans hoofdgebouw',
                'city' => 'Den Bosch',
                'street' => 'Onderwijsboulevard',
                'number' => '138',
                'postal_code' => '5223kk',
                'building_number' => '1'
            ]],
            [[
                'name' => $faker -> name,
                'city' => $faker -> city,
                'street' => $faker -> streetName,
                'number' => $faker -> numberBetween(0, 2000),
            ]],
        ];
    }

    /**
     * @dataProvider provideInvalidData
     *
     */
    public function test_invalid_data(array $data)
    {
        $request = new StoreLocationRequest();

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    public function provideInvalidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[]],//missing fields
            [[//missing name
                'city' => 'Den Bosch',
                'street' => 'Onderwijsboulevard',
                'number' => '1',
                'postal_code' => '5223kk'
            ]],
        ];
    }
}
