<?php

<<<<<<< HEAD:tests/unit/CollectionTest.php
=======
/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

>>>>>>> Drops in codeception:tests/unit/CollectionTest.php
namespace Indigo\Container;

use Fuel\Validation\Rule\Type;

/**
 * Tests for Collection Container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
<<<<<<< HEAD:tests/unit/CollectionTest.php
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Collection
=======
 * @coversDefaultClass Indigo\Container\Collection
 * @group              Container
>>>>>>> Drops in codeception:tests/unit/CollectionTest.php
 */
class CollectionTest extends AbstractContainerTest
{
<<<<<<< HEAD:tests/unit/CollectionTest.php
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
=======
    public function _before()
>>>>>>> Drops in codeception:tests/unit/CollectionTest.php
    {
        $container = new Collection($this->type, ['asd'], true);

        $this->assertSame($this->type, $container->getType());

        $this->assertEquals(['asd'], $container->getContents());
        $this->assertTrue($container->isReadOnly());
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $type = $this->container->getType();
        $container = new Collection($type);

        $this->assertSame($type, $container->getType());
    }

    /**
     * @covers ::getType
     */
    public function testType()
    {
        $this->assertSame($this->type, $this->container->getType());
    }

    /**
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     */
    public function testValidate()
    {
        $this->container->validate([123]);
    }

    /**
     * @covers            ::validateOne
     * @expectedException InvalidArgumentException
     */
    public function testValidateOne()
    {
        $this->assertNull($this->container->validateOne('123'));
        $this->container->validateOne(123);
    }

    /**
     * @covers ::set
     * @covers ::validate
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
     */
    public function testSetFailure()
    {
        $this->container->set('test', 123);
    }

    /**
     * @covers ::setContents
     * @covers ::validate
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
     */
    public function testSetContentsFailure()
    {
        $this->container->setContents(['test' => 123]);
    }

    /**
     * @covers ::merge
     * @covers ::validate
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
     */
    public function testMergeFailure()
    {
        $this->container->merge(
            array('test' => 123),
            new Collection(new Type('string'), ['test'])
        );
    }
}
