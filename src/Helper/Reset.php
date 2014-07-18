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
 * Reset Helper
 *
 * Use this trait to reset the data of the container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Reset
{
    /**
     * Resets the container
     *
     * @return boolean
     */
    public function reset()
    {
        $this->data = [];

        return true;
    }
}
