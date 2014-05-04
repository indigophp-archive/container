<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\RuleProvider;

use Fuel\Validation\Validator;
use InvalidArgumentException;

/**
 * Allows sets of validation rules to be generated from an array structure
 *
 * @package Fuel\Validation\RuleProvider
 * @author  Fuel Development Team
 * @since   2.0
 */
class FromStruct extends FromArray
{

    /**
     * The key of rules
     *
     * @var string
     */
    protected $ruleKey = 'rules';

    /**
     * The key of label
     *
     * @var string
     */
    protected $labelKey = 'label';

    public function __construct($ruleKey = 'rules', $labelKey = 'label')
    {
        $this->ruleKey = $ruleKey;
        $this->labelKey = $labelKey;
    }

    /**
     * Processes the given field and rules to add them to the validator.
     *
     * @param string    $field Name of the field to add rules to
     * @param array     $data  Array of field definition
     * @param Validator $validator Validator object to apply rules to
     *
     * @since 2.0
     */
    protected function addFieldRules($field, $data, Validator $validator)
    {
        $label = array_key_exists($this->labelKey, $data) ? $data[$this->labelKey] : null;
        $rules = array_key_exists($this->ruleKey, $data) ? $data[$this->ruleKey] : array();

        $validator->addField($field, $label);

        // Add each of the rules
        foreach ($rules as $ruleName => $params)
        {
            $this->addFieldRule($field, $ruleName, $params, $validator);
        }
    }

}
