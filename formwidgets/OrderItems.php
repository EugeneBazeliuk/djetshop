<?php namespace Djetson\Shop\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * OrderItems Form Widget
 */
class OrderItems extends FormWidgetBase
{
    use \Backend\Traits\WidgetMaker;
    use \System\Traits\ConfigMaker;

    protected $defaultAlias = 'djetson_shop_order_items';

    /** @var \Backend\Widgets\Form */
    protected $itemFormWidget;

    /**
     *
     */
    public function init()
    {
        $this->itemFormWidget = $this->createOrderItemFormWidget();
    }

    /**
     *
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('orderitems');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['model'] = $this->model;
    }

    /**
     * Load CREATE ITEM form
     * @return mixed
     */
    public function onLoadCreateItemForm()
    {
        $this->vars['itemFormWidget'] = $this->itemFormWidget;
        return $this->makePartial('orderitems_form_create');
    }

    /**
     * Create orderItem form widget
     */
    protected function createOrderItemFormWidget()
    {
        $config = $this->makeConfig('$/djetson/shop/models/orderitem/fields.yaml');
        $config->alias = 'orderItemForm';
        $config->arrayName = 'OrderItem';
        $config->model = new \Djetson\Shop\Models\OrderItem;

        $widget = $this->makeWidget('Backend\Widgets\Form', $config);
        $widget->bindToController();

        return $widget;
    }

    /**
     *
     */
    public function onCreateOrderItem()
    {
        $data = $this->itemFormWidget->getSaveData();
        $item = \Djetson\Shop\Models\OrderItem::create($data);

        $order = new \Djetson\Shop\Models\Order;
        $order->items()->add($item, $this->sessionKey);

        return $this->refreshOrderItemList();
    }

    /**
     *
     */
    protected function refreshOrderItemList()
    {
        $model = $this->getModel();
        $this->vars['items'] = $model->items()->withDeferred($this->sessionKey)->get();
        return ['#order-items' => $this->makePartial('orderitems_list')];
    }

    public function getSaveValue($value)
    {
        //$model = $this->getModel();


        $order = new \Djetson\Shop\Models\Order;
        return $order->items()->withDeferred($this->sessionKey)->get();
    }

    public function getModel()
    {
        return $this->model;
    }
}