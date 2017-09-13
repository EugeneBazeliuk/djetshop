<?php namespace Djetson\Shop\Tests;

/**
 * Trait ModelTestHelper
 *
 * @property \October\Rain\Database\Model $class
 *
 * @mixin \PluginTestCase
 * @mixin \PHPUnit_Framework_TestCase
 * @package Djetson\Shop
 */

trait ModelTestHelper {

    /**
     * @param $model \October\Rain\Database\Model
     * @param $checkField string
     */
    public function helperCreateModel($model, $checkField)
    {
        $model->save();
        $this->seeInDatabase($model->getTable(), [$checkField => $model->{$checkField}]);
    }

    /**
     * @param $model \October\Rain\Database\Model
     * @param $checkField string
     * @param $sluggableField string
     */
    public function helperCreateWithSluggable($model, $checkField, $sluggableField)
    {
        $model->{$sluggableField} = null;
        $model->save();
        $this->seeInDatabase($model->getTable(), [$checkField => $model->{$checkField}]);
    }

    /**
     * @param $model \October\Rain\Database\Model
     * @param $relationName string
     * @param $checkField string
     */
    public function helperBelongTo($model, $relationName, $checkField)
    {
        $relatedClass = $model->{$relationName}()->getRelated();
        $relatedModel = factory(get_class($relatedClass))->create();
        $model->{$relationName} = $relatedModel;
        $model->save();

        $this->assertEquals($model->{$relationName}->{$checkField}, $relatedModel->{$checkField});
    }

    /**
     * @param $model \October\Rain\Database\Model
     * @param $relationName string
     */
    public function helperHasMany($model, $relationName)
    {
        $relatedClass = $model->{$relationName}()->getRelated();
        $relatedModels = factory(get_class($relatedClass), 3)->make();
        $model->{$relationName} = $relatedModels;
        $model->save();

        $this->assertEquals(3, $model->$relationName->count());
    }

    /**
     * @param $model \October\Rain\Database\Model
     * @param $relationName string
     */
    public function helperBelongToMany($model, $relationName)
    {
        $relatedModels = factory(get_class($model->{$relationName}()->getRelated()), 3)->create();
        $model->{$relationName} = $relatedModels;
        $model->save();

        $this->assertEquals(3, $model->$relationName->count());
    }
}