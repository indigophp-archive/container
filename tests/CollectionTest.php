<?php

namespace Indigo\Container\Test;

use Indigo\Container\Collection;
use Fuel\Validation\Rule\Type;

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
        $type = new Type('string');
        $this->container = new Collection($type);
    }

    /**
     * @covers ::__construct
     * @covers ::validate
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new Collection(
            new Type('string'),
            array(
                'test' => 'test',
                'test2' => 'test2',
            )
        );
    }

    /**
     * @covers            ::__construct
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testConstructDatasetFailure()
    {
        $container = new Collection(new Type('string'), array(123));
    }

    /**
     * @covers ::getType
     * @group  Container
     */
    public function testType()
    {
        $this->assertEquals(new Type('string'), $this->container->getType());
    }

    /**
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testValidate()
    {
        $this->container->validate(array(123));
    }

    /**
     * @covers            ::validateOne
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testValidateOne()
    {
        $this->assertNull($this->container->validateOne('123'));
        $this->container->validateOne(123);
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
     * @covers            ::set
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testSetFailure()
    {
        $this->container->set('test', 123);
    }

    /**
     * @covers ::setContents
     * @covers ::validate
     * @group  Container
     */
    public function testSetContents()
    {
        $contents = array('test' => 'test');

        $this->container->setContents(array('test' => 'test'));

        $this->assertEquals($contents, $this->container->getContents());
    }

    /**
     * @covers            ::setContents
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testSetContentsFailure()
    {
        $this->container->setContents(array('test' => 123));
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
     * @covers            ::merge
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testMergeFailure()
    {
        $this->container->merge(
            array('test' => 123),
            new Collection(new Type('string'), array('test'))
        );
    }
}
