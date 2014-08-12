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
 * Tests for Id Helper
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Id
 * @group              Container
 * @group              Helper
 */
class IdTest extends AbstractContainerTest
{
    public function _before()
    {
        $this->container = new \HelperContainer([
            'key' => 'value'
        ]);
    }

    /**
     * @covers ::getId
     * @covers ::hashId
     * @covers ::setId
     */
    public function testGetSet()
    {
        $this->assertEquals(md5(serialize(['key' => 'value'])), $this->container->getId());

        $this->assertEquals($this->container, $this->container->setId('test_id'));

        $this->assertEquals('test_id', $this->container->getId());
    }

    /**
     * @covers            ::setId
     * @expectedException RuntimeException
     */
    public function testSetReadOnly()
    {
        $this->container->setReadOnly();

        $this->container->setId('test_id');
    }
}
