<?php namespace Djetson\Shop\Traits;

/**
 * Trait ModelTestHelper
 *
 * @mixin \PluginTestCase
 * @package Djetson\Shop
 */
use \October\Rain\Database\Model;

trait ModelTestHelper {

    /**
     * Test creation model
     * @param \October\Rain\Database\Model $class
     * @param string                       $field
     */
    public function createHelper(Model $class, string $field)
    {
        $model = factory(get_class($class))->create();
        $this->seeInDatabase($class->getTable(), [$field => $model->{$field}]);
    }

    /**
     * Test creation model with sluggable field
     * @param \October\Rain\Database\Model $class
     * @param string                       $field
     * @param string                       $sluggable
     */
    public function createSluggableHelper(Model $class, string $field, string $sluggable)
    {
        $model = factory(get_class($class))->create([$sluggable => null]);
        $this->seeInDatabase($class->getTable(), [$field => $model->{$field}]);
    }
}