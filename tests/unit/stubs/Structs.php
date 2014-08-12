<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Indigo\Container\Struct;

class ExampleStruct extends Struct
{
    protected $struct = [
        'email' => [
            'required',
            'email',
        ],
    ];
}

class AdvancedExampleStruct extends Struct
{
    protected $struct = [
        'email' => [
            'label' => 'Email',
            'rules' => [
                'required',
                'email',
            ],
        ],
    ];

    protected $labelKey = true;
}
