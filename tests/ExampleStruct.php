<?php

use Indigo\Container\Struct;

class ExampleStruct extends Struct
{
    protected static $struct = array(
        'email' => array(
            'label' => 'Email',
            'rules' => array(
                'required',
                'email',
            ),
        )
    );
}
