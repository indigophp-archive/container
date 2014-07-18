<?php

use Indigo\Container\Struct;

class ExampleStruct extends Struct
{
    protected $struct = array(
        'email' => array(
            'required',
            'email',
        )
    );
}

class AdvancedExampleStruct extends Struct
{
    protected $struct = array(
        'email' => array(
            'label' => 'Email',
            'rules' => array(
                'required',
                'email',
            ),
        )
    );

    protected $labelKey = true;
}
