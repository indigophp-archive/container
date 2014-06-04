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
use InvalidArgumentException;

/**
 * Collection container
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

    public function __construct(Type $type, array $data = array(), $readOnly = false)
    {
        $this->type = $type;

        $this->validate($data);

        parent::__construct($data, $readOnly);
    }

    /**
     * Get type of collection
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Validate a dataset
     *
     * @param  array                    $data
     * @throws InvalidArgumentException
     */
    public function validate(array $data)
    {
        foreach ($data as $value) {
            $this->validateOne($value);
        }
    }

    /**
     * Validate one value
     *
     * @param  mixed $value
     */
    public function validateOne($value)
    {
        if ($this->type->validate($value) === false) {
            throw new InvalidArgumentException($this->type->getMessage());
        }
    }

    /**
     * {@inheritdocs}
     */
    public function set($key, $value)
    {
        $this->validateOne($value);

        return parent::set($key, $value);
    }
}
