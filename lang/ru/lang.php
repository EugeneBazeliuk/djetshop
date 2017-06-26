<?php

return [

    // Plugin
    'plugin' => [
        'name' => 'Djetson Shop',
        'description' => 'Платформа для торговли',
        'label' => 'Магазин'
    ],

    // Permissions
    'permissions' => [
        'access_product' => 'Управление товарами',
        'access_categories' => 'Управление категориями',
        'access_manufacturers' => 'Управление производителями',
        'access_orders' => 'Управление заказами',
        'access_currencies' => 'Управление валютами',
        'access_shipping_methods' => 'Управление методами доставки',
        'access_payment_methods' => 'Управление методами оплаты',
        'access_binding' => 'Управление связями',
        'access_binding_type' => 'Управление типами связи',
    ],

    // Btn
    'btn' => [
        'create' => 'Создать'
    ],

    // Form
    'form' => [
        'name' => 'Название',
        'slug'  => 'Параметр URL',
        'code' => 'Уникальный код',
        'sku' => 'SKU код',
        'ean_13' => 'EAN13 код',
        'isbn' => 'ISBN код',
        'symbol' => 'Символ',
        'symbol_position' => 'Позиция символа',
        'symbol_position_before' => 'Перед стоимостью',
        'symbol_position_after' => 'После стоимости',
        'symbol_space' => 'Пробел между символом и ценой',
        'provider' => 'Поставщик',
        'provider_empty' => '--- Выберите поставщика ---',
        'free_shipping_limit' => 'Лимит бесплатной доставки',
        'mail_template' => 'Шаблон письма',
        'mail_template_empty' => '--- Выберите шаблон ---',
        'mail_template_section' => 'Настройка уведомления на E-mail',
        'description' => 'Описание',
        'meta_title' => 'Мета Title',
        'meta_keywords' => 'Мета Keywords',
        'meta_description' => 'Мета Description',
        'manufacturer' => 'Производитель',
        'package_width' => 'Ширина упаковки',
        'package_height' => 'Высота упаковки',
        'package_depth' => 'Глубина упаковки',
        'package_weight' => 'Вес упаковки',
        'category' => 'Категория',
        'categories' => 'Категории',
        'color' => 'Цвет',
        'binding_type' => 'Тип связи',


        'cost' => 'Стоимость',
        'price' => 'Цена',
        'price_original' => 'Текущая цена',
        'currency_default' => 'Основная валюта магазина',

        'is_active' => 'Статус активности',
        'is_searchable' => 'Статус индексации',
        'is_available' => 'Статус доступности',
        'is_available_option_true' => 'Доступен',
        'is_available_option_false' => 'Предзаказ',
        'is_unique_text' => 'Статус уникального наполнения',
        'is_allow_in_order' => 'Разрешить учитывать в заказе',
        'is_allow_free_shipping' => 'Разрешить бесплатную доставку',
        'is_send_email' => 'Отправить уведомление на E-mail?',
        'is_attach_invoice' => 'Прикрепить счёт во вложение?',

        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'deleted_at' => 'Удалено',

        'price_format_decimal_count' => 'Количество цифр после знака разделения',
        'price_format_decimal_point' => 'Знак разделения',
        'price_format_thousands_separator' => 'Знак разделения тысяч',
        'price_format_position' => 'Позиция знака валюты',
        'price_format_space' => 'Разделение числа и знака пробелом',

        'dropdown_empty' => '--- Выберите из списка ---',

        'tab' => [
            'settings' => 'Настройки',
            'general' => 'Основное',
            'seo' => 'SEO',
            'sizes' => 'Размеры',
            'categories' => 'Категории',
            'featured' => 'Связанные товары',
            'images' => 'Изображения',
            'currency' => 'Валюты'
        ]
    ],

    // List
    'list' => [
        'name' => 'Название',
        'slug'  => 'URL',
        'code' => 'Код',
        'sku' => 'SKU',
        'ean_13' => 'EAN13',
        'isbn' => 'ISBN',
        'symbol' => 'Символ',
        'symbol_position' => 'Позиция символа',
        'preview' => 'Предпросмотр',
        'provider' => 'Поставщик',

        'category' => 'Категория',
        'categories' => 'Категории',
        'binding_type' => 'Тип связи',

        'quantity' => 'Количество',
        'available' => 'Доступно',
        'preorder' => 'Предзаказ',

        'cost' => 'Стоимость',
        'price' => 'Цена',
        'price_original' => 'Текущая цена',

        'is_active' => 'Активность',
        'is_searchable' => 'Поиск',
        'is_available' => 'Доступность',
        'is_available_option_true' => 'Доступен',
        'is_available_option_false' => 'Предзаказ',
        'is_unique_text' => 'Текст',
        'is_allow_in_order' => 'Учитывать',
        'is_allow_free_shipping' => 'Бесплатная доставка',
        'is_send_email' => 'Отправить Email',
        'is_attach_invoice' => 'Отправить счёт',

        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'deleted_at' => 'Удалено',
    ],

    // Errors
    'errors' => [
        'failed_get_default_currency' => 'Не удалось получить валюту по умолчанию!',
        'failed_price_format_position' => 'Настройки позиции знака валюты заданы не верно',
    ],

    // Bindings
    'bindings' => [
        'label' => 'Связи',
        'create' => 'Создание связи',
        'update' => 'Обновление связи',
        'preview' => 'Просмотр связи',
    ],

    // Bindings
    'binding_types' => [
        'label' => 'Типы связи товара',
        'description' => 'Управление типами связи товара',
        'create' => 'Создание типа связи',
        'update' => 'Обновление типа связи',
        'preview' => 'Просмотр типа связи',
    ],

    // Categories
    'categories' => [
        'label' => 'Категории',
        'create' => 'Создание категории',
        'update' => 'Обновление категории',
        'preview' => 'Просмотр категории',
    ],

    // Currencies
    'currencies' => [
        'label' => 'Валюты',
        'description' => 'Управление валютами магазина',
        'create' => 'Создание валюты',
        'update' => 'Обновление валюты',
        'preview' => 'Просмотр валюты',
        'errors' => [
            'delete_default' => 'Вы не можете удалить основную валюту!'
        ]
    ],

    // Manufacturers
    'manufacturers' => [
        'label' => 'Производители',
        'create' => 'Создание производителя',
        'update' => 'Обновление производителя',
        'preview' => 'Просмотр производителя',
    ],

    // Orders
    'orders' => [
        'label' => 'Заказы'
    ],

    // Order statuses
    'order_statuses' => [
        'label' => 'Статусы счёта',
        'description' => 'Управление статусами счёта',
        'create' => 'Создание статуса счёта',
        'update' => 'Обновление статуса счёта',
        'preview' => 'Просмотр статуса счёта',
    ],

    // Payment methods
    'payment_methods' => [
        'label' => 'Методы оплаты',
        'description' => 'Управление методами оплаты',
        'create' => 'Создание метода оплаты',
        'update' => 'Обновление метода оплаты',
        'preview' => 'Просмотр метода оплаты',
        'errors' => [
            'provider_not_found' => 'Не удалось найти провайдер :provider'
        ]
    ],

    // Products
    'products' => [
        'label' => 'Товары',
        'create' => 'Создание товара',
        'update' => 'Обновление товара',
        'preview' => 'Просмотр товара',
    ],

    // Properties
    'properties' => [
        'label' => 'Свойства товара',
        'description' => 'Управление свойствами товара',
        'create' => 'Создание свойства',
        'update' => 'Обновление свойства',
        'preview' => 'Просмотр свойства',
    ],

    // Settings
    'settings' => [
        'label' => 'Настройки магазина',
        'description' => 'Управление основными настройками',
    ],

    // Settings category
    'setting_categories' => [
        'main' => "Djetson Shop"
    ],

    // Shipping methods
    'shipping_methods' => [
        'label' => 'Методы доставки',
        'description' => 'Управление методами доставки',
        'create' => 'Создание метода доставки',
        'update' => 'Обновление метода доставки',
        'preview' => 'Просмотр метода доставки',
    ],
];