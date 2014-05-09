<?php

namespace Indigo\Container\Test\Helper;

use Indigo\Container\Test\AbstractTest;

require_once(__DIR__.'/../../resources/HelperContainer.php');

/**
 * Tests for Reset trait
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Container\Helper\Reset
 */
class ResetTest extends AbstractTest
{
    public function setUp()
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
