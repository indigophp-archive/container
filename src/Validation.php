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
use InvalidArgumentException;

/**
 * Validation Container
 *
 * Validate data of container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Validation extends AbstractContainer
{
    /**
     * Validator object
     *
     * @var Validator
     */
    protected $validator;

    public function __construct(Validator $validator, array $data = array(), $readOnly = false)
    {
        $this->validator = $validator;

        $this->validate($data);

        parent::__construct($data, $readOnly);
    }

    /**
     * Get Validator object
     *
     * @return Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Set Validator object
     *
     * @param Validator   $validator
     * @return Validation
     */
    public function setValidator(Validator $validator)
    {
        $this->validator = $validator;

        $this->validate($this->data);

        return $this;
    }

    /**
     * Validate a dataset
     *
     * @param  array                    $data
     * @throws InvalidArgumentException
     */
    public function validate(array $data)
    {
        $result = $this->validator->run($data);

        if ($result->isValid() === false) {
            $error = $result->getErrors();
            $error = reset($error);

            throw new InvalidArgumentException($error);
        }
    }

    /**
     * {@inheritdocs}
     */
    public function set($key, $value)
    {
        $result = $this->validator->runField($key, array($key => $value));

        if ($result->isValid() === false) {
            throw new InvalidArgumentException($result->getError($key));
        }

        return parent::set($key, $value);
    }
}
