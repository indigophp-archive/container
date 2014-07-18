<?php

namespace Indigo\Container\Helper;

use Indigo\Container\AbstractTest;

/**
 * Tests for Reset trait
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Reset
 */
class ResetTest extends AbstractTest
{
    public function _before()
    {
        $this->container = new \HelperContainer(array(
            'key' => 'value'
        ));
    }

    /**
     * @covers ::reset
     * @group  Container
     */
    public function testReset()
    {
        $this->assertTrue($this->container->reset());
        $this->assertEquals(array(), $this->container->getContents());
    }
}
