<?php namespace Djetson\Shop\Tests\Unit\Models;

use PluginTestCase;
use Djetson\Shop\Tests\ModelTestHelper;

class CategoryTest extends PluginTestCase
{
    use ModelTestHelper;

    protected $class = 'Djetson\Shop\Models\Category';

    public function setUp()
    {
        parent::setUp();
        $this->app->register('Djetson\Shop\Providers\FactoryServiceProvider');
    }

    /**
     * Creation test
     */
    public function test_create()
    {
        $this->createHelper(new $this->class, 'name');
    }

    /**
     * Creation with sluggable trait test
     */
    public function test_create_with_slugable_trait()
    {
        $this->createSluggableHelper(new $this->class, 'slug');
    }
}