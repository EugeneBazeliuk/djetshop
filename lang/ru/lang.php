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

        'cost' => 'Стоимость',
        'price' => 'Цена',
        'price_original' => 'Текущая цена',

        'is_active' => 'Статус активности',
        'is_searchable' => 'Статус индексации',
        'is_available' => 'Статус доступности',
        'is_available_option_true' => 'Доступен',
        'is_available_option_false' => 'Предзаказ',
        'is_unique_text' => 'Статус уникального наполнения',

        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'deleted_at' => 'Удалено',
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

        'created_at' => 'Создано',
        'updated_at' => 'Обновлено',
        'deleted_at' => 'Удалено',
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
        'name' => 'Валюты',
        'manage' => 'Управление валютами',
        'create' => 'Создание валюты',
        'update' => 'Обновление валюты',
        'preview' => 'Просмотр валюты',
        'errors' => [
            'delete_default' => 'Вы не можете удалить основную валюту!'
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
            'currency_failed' => 'Не удалось задать валюту по умолчанию. Валюты ещё не созданы!'
        ],
        'currency' => 'Основная валюта магазина',
        'price_format_decimal_count' => 'Количество знаков дроби',
        'price_format_decimal_point' => 'Знак отделяющий целое число от дроби',
        'price_thousands_separator' => 'Разделитель тысяч',
        'price_format_position' => 'Позиция знака валюты',
        'price_format_space' => 'Разделение числа и знака пробелом',
    ],
];