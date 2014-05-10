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
 * Id Helper
 *
 * Generate unique identifier based on content
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait Id
{
    /**
     * Manually set ID
     *
     * @var string
     */
    protected $id;

    /**
     * Get ID
     *
     * @return string
     */
    public function getId()
    {
        if (isset($this->id)) {
            return $this->id;
        }

        $ignoreKeys = array();

        if (isset($this->ignoreKeys)) {
            $ignoreKeys = $this->ignoreKeys;
        }

        // Filter ignored keys
        $hashData = Arr::filterKeys($this->data, $ignoreKeys, true);

        return md5(serialize($hashData));
    }

    /**
     * Manually set ID
     *
     * @param  string $id
     * @return Id
     */
    public function setId($id = null)
    {
        if ($this->readOnly) {
            throw new \RuntimeException('Changing values on this Data Container is not allowed.');
        }

        $this->id = $id;

        return $this;
    }
}
