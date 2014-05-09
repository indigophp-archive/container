<?php

namespace Indigo\Container\Test\Helper;

use Indigo\Container\Test\AbstractTest;

require_once(__DIR__.'/../../resources/HelperContainer.php');

/**
 * Tests for Serializable trait
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Container\Helper\Serializable
 */
class SerialiazableTest extends AbstractTest
{
    public function setUp()
    {
        $this->container = new \HelperContainer(array(
            'key' => 'value'
        ));
    }

    /**
     * @covers ::serialize
     * @covers ::unserialize
     * @group  Container
     */
    public function testSerialize()
    {
        $this->assertEquals($this->container, unserialize(serialize($this->container)));
    }
}
