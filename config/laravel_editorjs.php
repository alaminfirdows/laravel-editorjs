<?php

return [
    'config'    => [
        'tools' => [
            'paragraph' => [
                'text'  => [
                    'type'          => 'string',
                    'allowedTags'   => 'i,b,a[href],code[class],mark[class]',
                ],
            ],
            'header' => [
                'text' => [
                    'type' => 'string',
                    'allowedTags' => 'a[href],mark[class]',
                ],
                'level' => [1, 2, 3, 4, 5, 6],
            ],
            'list' => [
                'style' => [
                    0 => 'ordered',
                    1 => 'unordered',
                ],
                'items' => [
                    'type' => 'array',
                    'data' => [
                        '-' => [
                            'type' => 'string',
                            'allowedTags' => 'i,b,a[href],code[class],mark[class]',
                        ],
                    ],
                ],
            ],
        ],
    ],
];