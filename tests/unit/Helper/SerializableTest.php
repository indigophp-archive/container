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

use Indigo\Container\AbstractContainerTest;

/**
 * Tests for Serializable Helper
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Serializable
 * @group              Container
 * @group              Helper
 */
class SerialiazableTest extends AbstractContainerTest
{
    public function _before()
    {
        $this->container = new \HelperContainer([
            'key' => 'value'
        ]);
    }

    /**
     * @covers ::serialize
     * @covers ::unserialize
     */
    public function testSerialize()
    {
        $this->assertEquals($this->container, unserialize(serialize($this->container)));
    }
}
