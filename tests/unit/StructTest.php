<?php

namespace Indigo\Container;

use Fuel\Validation\Validator;

/**
 * Tests for Struct container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Struct
 */
class StructTest extends AbstractTest
{
    public function _before()
    {
        $this->container = new \ExampleStruct([
            'email' => 'email@domain.com'
        ]);
    }

    /**
     * @covers ::__construct
     * @group  Container
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
     * @group  Container
     */
    public function testValidator()
    {
        $this->assertEquals($this->container->createValidator(), $this->container->populateValidator(new Validator));
    }
}
