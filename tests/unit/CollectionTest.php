<?php

namespace Indigo\Container;

use Fuel\Validation\Rule\Type;

/**
 * Tests for Collection container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Collection
 */
class CollectionTest extends AbstractTest
{
    protected $type;

    public function _before()
    {
        $this->type = new Type('string');
        $this->container = new Collection($this->type);
    }

    /**
     * @covers ::__construct
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new Collection($this->type, ['asd'], true);

        $this->assertSame($this->type, $container->getType());

        $this->assertEquals(['asd'], $container->getContents());
        $this->assertTrue($container->isReadOnly());
    }

    /**
     * @covers ::getType
     * @group  Container
     */
    public function testType()
    {
        $this->assertSame($this->type, $this->container->getType());
    }

    /**
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testValidate()
    {
        $this->container->validate([123]);
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

        $this->container->setContents(['test' => 'test']);

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
        $this->container->setContents(['test' => 123]);
    }

    /**
     * @covers ::merge
     * @covers ::validate
     * @group  Container
     */
    public function testMerge()
    {
        $this->container->merge(['test' => 'test']);

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
            new Collection(new Type('string'), ['test'])
        );
    }
}
