<?php namespace Djetson\Shop\Tests;

/**
 * Trait ModelTestHelper
 * @mixin
 * @package Djetson\Shop
 */

trait ModelTestHelper {

    /**
     * Test creation model
     * @param \October\Rain\Database\Model $class
     * @param string                       $field
     */
    public function createHelper($class, string $field)
    {
        $model = factory(get_class($class))->create();
        $this->seeInDatabase($class->getTable(), [$field => $model->{$field}]);
    }

    /**
     * Test creation model with sluggable field
     * @param \October\Rain\Database\Model $class
     * @param string                       $field
     */
    public function createSluggableHelper($class, string $field)
    {
        $model = factory(get_class($class))->create([$field => null]);
        $this->seeInDatabase($class->getTable(), [$field => $model->$field]);
    }

    /**
     * @param \October\Rain\Database\Model  $class
     * @param string                        $relationName
     */
    public function helperBelongToMany($class, $relationName)
    {
        $model = factory(get_class($class))->create();
        $relatedClass = $model->{$relationName}()->getRelated();
        $relatedModel = factory(get_class($relatedClass))->create();
        $model->{$relationName}()->add($relatedModel);

        $this->assertEquals(1, $model->$relationName()->count());
    }

    public function helperBelongTo(\October\Rain\Database\Model $class, $relationName)
    {
        $model = factory(get_class($class))->create();
        $relatedClass = $class->{$relationName}()->getRelated();
        $relatedModel = factory(get_class($relatedClass))->create();

        $model->$relationName()->associate($relatedModel);

        $this->assertEquals(1, $model->$relationName()->count());
    }
}