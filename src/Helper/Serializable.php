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

/**
 * Serializable Helper
 *
 * Use this trait to serialize the data of the container
 *
 * IMPORTANT: Don't forget to implement Serializable interface as well
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Serializable
{
    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize($this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
        $this->data = unserialize($data);
    }
}
