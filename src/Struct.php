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
use Fuel\Validation\ValidationAwareInterface;
use Fuel\Validation\RuleProvider\FromArray;

/**
 * Struct Container
 *
 * DataContainer to store a given structure with validation
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Struct extends Validation implements ValidationAwareInterface
{
    /**
     * Struct
     *
     * @var []
     */
    protected $struct = [];

    /**
     * If set, the structure must have this key along with the rule key
     *
     * @var string
     */
    protected $labelKey;

    /**
     * Rule key
     *
     * @var string
     */
    protected $ruleKey = 'rules';

    /**
     * Default Validator class
     *
     * @var string
     */
    protected $validatorClass = 'Fuel\\Validation\\Validator';

    /**
     * Creates a new Struct
     *
     * @param []      $data
     * @param boolean $readOnly
     */
    public function __construct(array $data = [], $readOnly = false)
    {
        $validator = $this->createValidator();

        parent::__construct($validator, $data, $readOnly);
    }

    /**
     * Creates a Validator object
     *
     * @return Validator
     */
    public function createValidator()
    {
        $validator = new $this->validatorClass;

        return $this->populateValidator($validator);
    }

    /**
     * {@inheritdoc}
     */
    public function populateValidator(Validator $validator)
    {
        $generator = new FromArray($this->labelKey, $this->ruleKey);
        $generator->setData($this->struct)->populateValidator($validator);

        return $validator;
    }
}
