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

/**
 * Struct Container
 *
 * DataContainer to store a given structure with validation
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Struct extends Validation
{
    protected $struct = array();

    protected $validatorClass = 'Fuel\\Validation\\Validator';

    public function __construct(array $data = array(), $readOnly = false)
    {
        $validator = $this->createValidator();

        parent::__construct($validator, $data, $readOnly);
    }

    public function createValidator()
    {
        $validator = new $this->validatorClass;

        return $this->populateValidator($validator);
    }

    public function populateValidator(Validator $validator)
    {
        $generator = new FromStruct;
        $generator->setData($this->struct)->populateValidator($validator);

        return $validator;
    }
}
