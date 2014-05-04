<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Container;

use Fuel\Validation\Validator;
use Fuel\Validation\RuleProvider\FromStruct;
use Fuel\Common\Arr;

/**
 * Struct Container
 *
 * DataContainer to store a given structure with validation
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Struct extends Validation
{
    protected static $struct = array();

    protected static $validatorClass = 'Fuel\\Validation\\Validator';

    public function __construct(array $data = array(), $readOnly = false)
    {
        $validator = $this->createValidator();

        parent::__construct($validator, $data, $readOnly);
    }

    public static function createValidator()
    {
        $validator = new static::$validatorClass;
        return static::populateValidator($validator);
    }

    public static function populateValidator(Validator $validator)
    {
        $generator = new FromStruct;
        $generator->setData(static::$struct)->populateValidator($validator);

        return $validator;
    }
}
