<?php

return [

    'shipping' => [

        'methods' => [

            'self' => [
                'name' => 'Self',
                'provider'   => 'self',
            ],

            'novaposhta' => [
                'name' => 'Novaposhta',
                'provider'   => 'novaposhta',
            ],

            'ukrposhta' => [
                'name' => 'Ukrposhta',
                'provider'   => 'ukrposhta',
            ],

        ],

    ],

    'payments' => [

        'methods' => [

            'self' => [
                'name' => 'Self',
                'provider'   => 'self',
            ],

            'privatbank' => [
                'name' => 'Приватбанк',
                'provider'   => 'privatbank',
            ]

        ],

    ],
];