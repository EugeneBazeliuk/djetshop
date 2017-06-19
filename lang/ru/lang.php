<?php

return [

    // Plugin
    'plugin' => [
        'name' => 'Djetson Shop',
        'description' => 'Платформа для торговли',
        'menu_label' => 'Магазин'
    ],

    // Permissions
    'permissions' => [
        'access_product' => 'Управление товарами',
        'access_categories' => 'Управление категориями',
        'access_manufacturers' => 'Управление производителями',
        'access_orders' => 'Управление заказами',
        'access_currencies' => 'Управление валютами',
        'access_shipping_methods' => 'Управление методами доставки',
        'access_payment_methods' => 'Управление методами оплаты'
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

        'cost' => 'Стоимость',
        'price' => 'Цена',
        'price_original' => 'Текущая цена',

        'is_active' => 'Статус активности',
        'is_searchable' => 'Статус индексации',
        'is_available' => 'Статус доступности',
        'is_available_option_true' => 'Доступен',
        'is_available_option_false' => 'Предзаказ',
        'is_unique_text' => 'Статус уникального наполнения',
        'is_allow_in_order' => 'Разрешить учитывать в заказе',
        'is_allow_free_shipping' => 'Разрешить бесплатную доставку',

        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'deleted_at' => 'Удалено',

        'tab' => [
            'settings' => 'Настройки',
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

        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'deleted_at' => 'Удалено',
    ],

    // Btn
    'btn' => [
        'create' => 'Создать'
    ],

    // Products
    'products' => [
        'menu_label' => 'Товары'
    ],

    // Categories
    'categories' => [
        'menu_label' => 'Категории'
    ],

    // Manufacturers
    'manufacturers' => [
        'menu_label' => 'Производители'
    ],

    // Orders
    'orders' => [
        'menu_label' => 'Заказы'
    ],

    // Currencies
    'currencies' => [
        'label' => 'Валюты',
        'manage' => 'Управление валютами',
        'create' => 'Создание валюты',
        'update' => 'Обновление валюты',
        'preview' => 'Просмотр валюты',
        'errors' => [
            'delete_default' => 'Вы не можете удалить основную валюту!'
        ]
    ],

    // Shipping methods
    'shipping_methods' => [
        'label' => 'Методы доставки',
        'manage' => 'Управление методами доставки',
        'create' => 'Создание метода доставки',
        'update' => 'Обновление метода доставки',
        'preview' => 'Просмотр метода доставки',
    ],

    // Payment methods
    'payment_methods' => [
        'label' => 'Методы оплаты',
        'manage' => 'Управление методами оплаты',
        'create' => 'Создание метода оплаты',
        'update' => 'Обновление метода оплаты',
        'preview' => 'Просмотр метода оплаты',
        'errors' => [
            'provider_not_found' => 'Не удалось найти провайдер :provider'
        ]
    ],

    // Settings
    'settings' => [
        'plugin_settings_category' => 'Djetson Shop',
        'general' => [
            'label' => 'Настройки магазина',
            'description' => 'Управление основными настройками',
            'category' => 'Djetson Shop',
        ],
        'currencies' => [
            'label' => 'Валюты',
            'description' => 'Управление валютами',
            'category' => 'Djetson Shop',
        ],
        'shipping_methods' => [
            'label' => 'Методы доставки',
            'description' => 'Управление методами доставки',
            'category' => 'Djetson Shop',
        ],
        'payment_methods' => [
            'label' => 'Методы оплаты',
            'description' => 'Управление методами оплаты',
            'category' => 'Djetson Shop',
        ],
        'tab' => [
            'currency' => 'Валюта'
        ],
        'errors' => [
            'failed_default_currency' => 'Не удалось получить валюту по умолчанию!',
            'failed_price_format_position' => 'Настройки позиции знака валюты заданы не верно'
        ],
        'currency' => 'Основная валюта магазина',
        'price_format_decimal_count' => 'Количество цифр после знака разделения',
        'price_format_decimal_point' => 'Знак разделения',
        'price_format_thousands_separator' => 'Знак разделения тысяч',
        'price_format_position' => 'Позиция знака валюты',
        'price_format_space' => 'Разделение числа и знака пробелом',
    ],
];