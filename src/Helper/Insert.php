<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Container\Helper;

use Fuel\Common\Arr;

/**
 * Insert Helper
 *
 * Use this trait to insert elements
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Insert
{
    /**
     * Inserts an element to container
     *
     * @param mixed   $value
     * @param integer $pos   Insert at custom position
     *
     * @return DataContainer
     *
     * @throws RuntimeException
     */
    public function insert($value, $pos = null)
    {
        return $this->insertAssoc(null, $value, $pos);
    }

    /**
     * Inserts an assoc element to container
     *
     * @param string  $key
     * @param mixed   $value
     * @param integer $pos
     *
     * @return DataContainer
     *
     * @throws RuntimeException
     */
    public function insertAssoc($key, $value, $pos = null)
    {
        if ($pos === null) {
            $this->set($key, $value);
        } else {
            if ($this->readOnly) {
                throw new \RuntimeException('Changing values on this Data Container is not allowed.');
            }

            $this->isModified = true;

            if (abs($pos) > count($this->data)) {
                $pos = count($this->data) * min(1, max(-1, $pos));
            }

            if ($key === null) {
                Arr::insert($this->data, $value, $pos);
            } else {
                Arr::insertAssoc($this->data, array($key => $value), $pos);
            }
        }

        return $this;
    }
}
