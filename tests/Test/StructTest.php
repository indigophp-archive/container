<?php

namespace Indigo\Container\Test;

use Indigo\Container\Struct;
use Fuel\Validation\Validator;

/**
 * Tests for Struct container
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 * @coversDefaultClass  Indigo\Container\Struct
 */
class StructTest extends AbstractTest
{
    public function setUp()
    {
        $this->container = new Struct;
    }

    /**
     * @covers ::__construct
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new Struct(
            array(
                'email' => 'user@example.com'
            )
        );
    }

    /**
     * @covers ::populateValidator
     * @group  Container
     */
    public function testPopulate()
    {
        $validator = new Validator;

        $this->assertSame(
            $validator,
            $this->container->populateValidator($validator)
        );
    }
}
