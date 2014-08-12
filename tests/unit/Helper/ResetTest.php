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
 * Tests for Reset Helper
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Reset
 * @group              Container
 * @group              Helper
 */
class ResetTest extends AbstractContainerTest
{
    public function _before()
    {
        $this->container = new \HelperContainer([
            'key' => 'value'
        ]);
    }

    /**
     * @covers ::reset
     */
    public function testReset()
    {
        $this->assertTrue($this->container->reset());
        $this->assertEquals([], $this->container->getContents());
    }
}
