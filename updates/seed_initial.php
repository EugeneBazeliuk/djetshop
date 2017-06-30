<?php namespace Djetson\Shop\Updates;

use App;
use Seeder;

class SeedInitial extends Seeder
{
    public function run()
    {
        // Register plugin Factories
        App::register('Djetson\Shop\Providers\FactoryServiceProvider');

        factory('Djetson\Shop\Models\BindingType', 5)->create();
        factory('Djetson\Shop\Models\Binding', 5)->make()->each(function (\Djetson\Shop\Models\Binding $model) {
            $model->binding_type()->associate(random_int(1,5));
            $model->save();
        });
        factory('Djetson\Shop\Models\Category', 5)->create();
        factory('Djetson\Shop\Models\Manufacturer', 5)->create();
        factory('Djetson\Shop\Models\Product', 5)->make()->each(function (\Djetson\Shop\Models\Product $model) {
            $model->category()->associate(random_int(1,5));
            $model->manufacturer()->associate(random_int(1,5));
            $model->save();
        });

        factory('Djetson\Shop\Models\PropertyGroup', 5)->create();


        factory('Djetson\Shop\Models\Property', 5)->create()->each(function (\Djetson\Shop\Models\Property $model) {
            $model->group()->associate(random_int(1,5));
            $model->values()->addMany(factory('Djetson\Shop\Models\PropertyValue', 5)->make());
            $model->save();
        });


        factory('Djetson\Shop\Models\Currency', 5)->create();
        factory('Djetson\Shop\Models\OrderStatus', 5)->create();
        factory('Djetson\Shop\Models\PaymentMethod', 5)->create();
        factory('Djetson\Shop\Models\ShippingMethod', 5)->create();
    }
}