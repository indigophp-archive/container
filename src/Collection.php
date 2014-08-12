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

use Fuel\Validation\Rule\Type;

/**
 * Collection Container
 *
 * Store a collection of type
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Collection extends AbstractContainer
{
    /**
     * Holds the Type rule object
     *
     * @var Type
     */
    private $type;

    /**
     * Creates a new Collection Container
     *
     * @param Type    $type
     * @param []      $data
     * @param boolean $readOnly
     */
    public function __construct(Type $type, array $data = [], $readOnly = false)
    {
        $this->type = $type;

        $this->validate($data);

        parent::__construct($data, $readOnly);
    }

    /**
     * Returns the type of collection
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Validates a dataset
     *
     * @param [] $data
     */
    public function validate(array $data)
    {
        foreach ($data as $value) {
            $this->validateOne($value);
        }
    }

    /**
     * Validates one value
     *
     * @param mixed $value
     *
     * @throws InvalidArgumentException
     */
    public function validateOne($value)
    {
        if ($this->type->validate($value) === false) {
            throw new \InvalidArgumentException($this->type->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->validateOne($value);

        return parent::set($key, $value);
    }
}
