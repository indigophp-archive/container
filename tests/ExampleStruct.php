<?php

use Indigo\Container\Struct;

class ExampleStruct extends Struct
{
    protected $struct = array(
        // 'email' => array(
        //     'label' => 'Email',
        //     'rules' => array(
        //         'required',
        //         'email',
        //     ),
        // )
        'email' => array(
            'required',
            'email',
        )
    );
}
