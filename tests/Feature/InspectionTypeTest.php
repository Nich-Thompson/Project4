<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class InspectionTypeTest extends TestCase
{
    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid(array $data)
    {
        $request = new Request();
        $rules = array();
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                "name" => "typename",
                "description" => "typedescription",
                "color" => "#FF3333",
                "icon_id" => "1"
            ]],
            [[
                "name" => $faker->word,
                "description" => $faker->sentence,
                "color" => $faker->hexColor,
                "icon_id" => "1"
            ]]
        ];
    }
}
