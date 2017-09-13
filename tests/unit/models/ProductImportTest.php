<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Models\ProductImport;

/**
 * Class ProductImportTest
 * @package Djetson\Shop\Tests\Unit\Models
 *
 * @property \Djetson\Shop\Models\Product $model
 *
 * @mixin \PHPUnit_Framework_TestCase
 */
class ProductImportTest extends PluginTestCase
{

    public function test_import()
    {
        $name = "Test Product";
        $sku = "123456";
        $price = '0.00';
        $categoryName1 = "Test category 1";
        $categoryName2 = "Test category 2";
        $manufacturerName = "Test manufacturer";
        $bindingCode = 'binding';
        $bindingName1 = "Test binding 1";
        $bindingName2 = "Test binding 2";

        $importData = [
            [
                "name" => $name,
                "sku" => $sku,
                "price" => $price,
                "bindings" => implode('|', [implode('::', [$bindingCode, $bindingName1]), implode('::', [$bindingCode, $bindingName2])]),
                "category" => $categoryName1,
                "categories" => implode('|', [$categoryName1, $categoryName2]),
                "manufacturer" => $manufacturerName
            ]
        ];

        $pi = new ProductImport;
        $pi->importData($importData);
        $results = $pi->getResultStats();
        $model = \Djetson\Shop\Models\Product::whereSku($sku)->first();

        // Test count created
        $this->assertEquals(1, $results->created);
        // Check model in database
        $this->seeInDatabase('djetshop_products', ['name' => $name]);
        // Check category name
        $this->assertEquals($categoryName1, $model->category->name);
        // Check manufacturer name
        $this->assertEquals($manufacturerName, $model->manufacturer->name);
        // Check categories count
        $this->assertEquals(2, $model->categories->count());
        // Check categories 1 name
        $this->assertEquals($categoryName1, $model->categories->where('name', $categoryName1)->pluck('name')->first());
        // Check categories 2 name
        $this->assertEquals($categoryName2, $model->categories->where('name', $categoryName2)->pluck('name')->first());
        // Check bindings count
        $this->assertEquals(2, $model->bindings->count());
        // Check bindings 1 name
        $this->assertEquals($bindingName1, $model->bindings->where('name', $bindingName1)->pluck('name')->first());
        // Check bindings 2 name
        $this->assertEquals($bindingName2, $model->bindings->where('name', $bindingName2)->pluck('name')->first());
    }
}