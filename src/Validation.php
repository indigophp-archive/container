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

use Fuel\Validation\ContainerValidator as Validator;
use Fuel\Validation\RuleProvider\FromArray;
use Fuel\Common\DataContainer;
use InvalidArgumentException;

/**
 * Validation Container
 *
 * Validate data of container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Validation extends DataContainer
{
    protected $validator;

    public function __construct(Validator $validator, array $data = array(), $readOnly = false)
    {
        $this->validator = $validator;

        $result = $validator->run($data);

        if ($result->isValid() === false) {
            $error = $result->getErrors();

            throw new InvalidArgumentException(reset($error));
        }

        parent::__construct($data, $readOnly);
    }

    /**
     * {@inheritdocs}
     */
    public function set($key, $value)
    {
        $result = $this->validator->runField($key, $value, $this->data);

        if ($result->isValid() === false) {
            $error = $result->getError($key);

            throw new InvalidArgumentException($error);
        }

        return parent::set($key, $value);
    }

    /**
     * {@inheritdocs}
     */
    public function merge($arg)
    {
        $arguments = array_map(function ($array) {
            if ($array instanceof DataContainer) {
                return $array->getContents();
            }

            return $array;

        }, func_get_args());

        array_unshift($arguments, $this->data);

        $arguments = call_user_func_array('Fuel\\Common\\Arr::merge', $arguments);

        $result = $this->validator->run($arguments);

        if ($result->isValid() === false) {
            $error = $result->getErrors();

            throw new InvalidArgumentException(reset($error));
        }

        return parent::merge($arguments);
    }
}
