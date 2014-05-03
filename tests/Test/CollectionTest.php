<?php

namespace Indigo\Container\Test;

use Indigo\Container\Collection;

/**
 * Tests for Collection container
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Container\Collection
 */
class CollectionTest extends AbstractTest
{
    public function setUp()
    {
        $this->container = new Collection('string');
    }

    /**
     * @covers ::__construct
     * @covers ::validate
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new Collection(
            'string',
            array(
                'test' => 'test',
                'test2' => 'test2',
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::validate
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Invalid type.
     * @group  Container
     */
    public function testConstructFailure()
    {
        $container = new Collection(123);
    }

    /**
     * @covers ::__construct
     * @covers ::validate
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testConstructDatasetFailure()
    {
        $container = new Collection('string', array(123));
    }

    /**
     * @covers ::getType
     * @group  Container
     */
    public function testType()
    {
        $this->assertEquals('string', $this->container->getType());
    }

    /**
     * @covers ::isPrimitive
     * @group  Container
     */
    public function testIsPrimitive()
    {
        $this->assertTrue($this->container->isPrimitive());
    }

    /**
     * @covers ::isValid
     * @group  Container
     */
    public function testValid()
    {
        $this->assertTrue($this->container->isValid('string'));
        $this->assertFalse($this->container->isValid(123));

        $container = new Collection('stdClass');

        $this->assertTrue($container->isValid(new \stdClass()));
    }

    /**
     * @covers ::validate
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testValidate()
    {
        $this->container->validate(123);
    }

    /**
     * @covers ::set
     * @covers ::validate
     * @group  Container
     */
    public function testSet()
    {
        $this->container->set('test', 'test');

        $this->assertEquals('test', $this->container->get('test'));
    }

    /**
     * @covers ::set
     * @covers ::validate
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testSetFailure()
    {
        $this->container->set('test', 123);
    }

    /**
     * @covers ::merge
     * @covers ::validate
     * @group  Container
     */
    public function testMerge()
    {
        $this->container->merge(array('test' => 'test'));

        $this->assertEquals('test', $this->container->get('test'));
    }

    /**
     * @covers ::merge
     * @covers ::validate
     * @expectedException InvalidArgumentException
     * @group  Container
     */
    public function testMergeFailure()
    {
        $this->container->merge(
            array('test' => 123),
            new Collection('string', array('test'))
        );
    }
}
