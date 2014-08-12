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

use Fuel\Common\DataContainer;

if (class_exists('Arr') === false) {
    // make Arr available in the global namespace
    class_alias('Fuel\Common\Arr', 'Arr');
}

/**
 * Abstract Container
 *
 * Common container method
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractContainer extends DataContainer
{
    /**
     * Validates a dataset
     *
     * @param [] $data
     *
     * @throws InvalidArgumentException
     */
    abstract public function validate(array $data);

    /**
     * {@inheritdoc}
     */
    public function setContents(array $data)
    {
        $this->validate($data);

        return parent::setContents($data);
    }

    /**
     * {@inheritdoc}
     */
    public function merge($arg)
    {
        $data = $this->data;

        $return = call_user_func_array('parent::merge', func_get_args());

        try {
            $this->validate($this->data);
        } catch (\InvalidArgumentException $e) {
            $this->data = $data;

            throw $e;
        }

        return $return;
    }
}
