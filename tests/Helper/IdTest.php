<?php

namespace Indigo\Container\Test\Helper;

use Indigo\Container\Test\AbstractTest;

require_once(__DIR__.'/../../resources/HelperContainer.php');

/**
 * Tests for Id trait
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass  Indigo\Container\Helper\Id
 */
class IdTest extends AbstractTest
{
    public function setUp()
    {
        $this->container = new \HelperContainer(array(
            'key' => 'value'
        ));
    }

    /**
     * @covers ::getId
     * @covers ::setId
     * @group  Container
     */
    public function testGetSet()
    {
        $this->assertEquals(md5(serialize(array('key' => 'value'))), $this->container->getId());

        $this->assertEquals($this->container, $this->container->setId('test_id'));

        $this->assertEquals('test_id', $this->container->getId());
    }

    /**
     * @covers            ::setId
     * @expectedException RuntimeException
     * @group             Container
     */
    public function testSetReadOnly()
    {
        $this->container->setReadOnly();

        $this->container->setId('test_id');
    }
}
