<?php namespace Djetson\Shop\Models;

/**
 * Product Model
 * @package Djetson\Shop
 */
class ProductImport extends \Backend\Models\ImportModel
{
    /**
     * @var array The rules to be applied to the data.
     */
    public $rules = [];

    protected $bindingNameCache = [];
    protected $bindingTypeCache = [];
    protected $categoryNameCache = [];
    protected $manufacturerNameCache = [];

    public function importData($results, $sessionKey = null)
    {
        //
        // Import
        //
        foreach ($results as $row => $data) {
            try {

                // Check Name
                if (!$name = array_get($data, 'name')) {
                    $this->logSkipped($row, 'Missing product name');
                    continue;
                };

                // Check Name
                if (!$sku = array_get($data, 'sku')) {
                    $this->logSkipped($row, 'Missing product sku');
                    continue;
                };

                //
                // Find or create
                //
                $product = Product::make();
                $product = $this->findDuplicateProduct($data) ?: $product;
                $productExists  = $product->exists;

                //
                // Set attributes
                //
                $except = ['id', 'bindings', 'categories', 'category', 'manufacturer', 'properties'];

                foreach (array_except($data, $except) as $attribute => $value) {
                    $product->{$attribute} = $value ?: null;
                }

                //
                // Add category
                //
                if ($categoryId = $this->getCategoryIdForProduct($data)) {
                    $product->category = $categoryId;
                }

                //
                // Add manufacturer
                //
                if ($manufacturerId = $this->getManufacturerIdForProduct($data)) {
                    $product->manufacturer = $manufacturerId;
                }

                //
                // Save
                //
                $product->forceSave();

                //
                // Add bindings
                //
                if ($bindingIds = $this->getBindingsIdsForProduct($data)) {
                    $product->bindings()->sync($bindingIds, false);
                }

                //
                // Add categories
                //
                if ($categoryIds = $this->getCategoriesIdsForProduct($data)) {
                    $product->categories()->sync($categoryIds, false);
                }

                //
                // Log results
                //
                if ($productExists) {
                    $this->logUpdated();
                }
                else {
                    $this->logCreated();
                }
            }
            catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    /**
     * @param $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function findDuplicateProduct($data)
    {
        if ($id = array_get($data, 'id')) {
            return Product::find($id);
        }

        $product = Product::where('sku', array_get($data, 'sku'))->first();

        return $product;
    }

    /**
     *
     */
    private function getBindingsIdsForProduct($data)
    {
        $ids = [];

        if ($bindingsString = array_get($data, 'bindings')) {

            if (is_array($bindings = $this->decodeArrayValue($bindingsString))) {

                foreach ($bindings as $bindingString)
                {
                    $binding = $this->decodeArrayValue($bindingString, '::');
                    $name = end($binding);
                    $bindingTypeId = $this->getBindingTypeId(reset($binding));

                    if (isset($this->categoryNameCache[$bindingTypeId][$name])) {
                        $ids[] = $this->bindingNameCache[$bindingTypeId][$name];
                    }
                    else {
                        $newBinding = Binding::firstOrCreate(['name' => $name, 'type_id' => $bindingTypeId]);
                        $ids[] = $this->bindingNameCache[$bindingTypeId][$name] = $newBinding->id;
                    }
                }
            }
        }

        return $ids;
    }

    /**
     *
     */
    private function getBindingTypeId($code)
    {
        if (isset($this->bindingTypeCache[$code])) {
            $id = $this->bindingTypeCache[$code];
        }
        else {
            $newBindingType = BindingType::firstOrCreate(['name' => $code, 'code' => $code]);
            $id = $this->bindingTypeCache[$code] = $newBindingType->id;
        }

        return $id;
    }

    /**
     * Get category id
     * @param $data
     * @return mixed
     */
    private function getCategoryIdForProduct($data)
    {
        $name = array_get($data, 'category');

        if (isset($this->categoryNameCache[$name])) {
            $id = $this->categoryNameCache[$name];
        }
        else {
            $newCategory = Category::firstOrCreate(['name' => $name]);
            $id = $this->categoryNameCache[$name] = $newCategory->id;
        }

        return $id;
    }

    /**
     * Get categories ids for product
     * @param $data
     * @return array
     */
    private function getCategoriesIdsForProduct($data)
    {
        $ids = [];

        $categoryNames = $this->decodeArrayValue(array_get($data, 'categories'));

        foreach ($categoryNames as $name) {
            if (!$name = trim($name)) {
                continue;
            }

            if (isset($this->categoryNameCache[$name])) {
                $ids[] = $this->categoryNameCache[$name];
            }
            else {
                $newCategory = Category::firstOrCreate(['name' => $name]);
                $ids[] = $this->categoryNameCache[$name] = $newCategory->id;
            }
        }

        return $ids;
    }

    /**
     * Get manufacturer id
     * @param $data
     * @return mixed
     */
    private function getManufacturerIdForProduct($data)
    {
        $name = array_get($data, 'manufacturer');

        if (isset($this->manufacturerNameCache[$name])) {
            $id = $this->manufacturerNameCache[$name];
        }
        else {
            $newManufacturer = Manufacturer::firstOrCreate(['name' => $name]);
            $id = $this->manufacturerNameCache[$name] = $newManufacturer->id;
        }

        return $id;
    }
}