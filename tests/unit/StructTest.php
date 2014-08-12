<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Container;

use Fuel\Validation\Validator;

/**
 * Tests for Struct container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Struct
 * @group              Container
 */
class StructTest extends AbstractContainerTest
{
    public function _before()
    {
        $this->container = new \ExampleStruct([
            'email' => 'email@domain.com'
        ]);
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $data = [
            'email' => 'email@domain.com'
        ];

        $container = new \ExampleStruct($data, true);

        $this->assertEquals($data, $container->getContents());
        $this->assertTrue($container->isReadOnly());
    }

    /**
     * @covers ::createValidator
     * @covers ::populateValidator
     */
    public function testValidator()
    {
        $this->assertEquals($this->container->createValidator(), $this->container->populateValidator(new Validator));
    }

    /**
     * @covers ::getProvider
     * @covers ::setProvider
     */
    public function testProvider()
    {
        $provider = \Mockery::mock('Fuel\\Validation\\ValidationAwareInterface');

        $provider->shouldReceive('setData')
            ->andReturn($provider);

        $this->assertSame($this->container, $this->container->setProvider($provider));
        $this->assertSame($provider, $this->container->getProvider());
    }
}
