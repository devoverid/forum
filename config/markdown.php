<?php

return [

    /* -----------------------------------------------------------------
     |  Parsers
     | -----------------------------------------------------------------
     */

    'default' => 'commonmark',

    'parsers' => [
        'commonmark' => [
            'class' => Arcanedev\LaravelMarkdown\Parsers\CommonMarkParser::class,
        ],
    ],

];
