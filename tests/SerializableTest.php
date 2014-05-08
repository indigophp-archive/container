<?php

namespace Indigo\Container\Test;

require_once(__DIR__.'/../resources/SerializableContainer.php');

/**
 * Tests for Serializable trait
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Container\Serializable
 */
class SerialiazableTest extends AbstractTest
{
    public function setUp()
    {
        $this->container = new \SerializableContainer(array(
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