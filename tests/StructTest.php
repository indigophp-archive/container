<?php

namespace Indigo\Container\Test;

use Indigo\Container\Struct;
use Fuel\Validation\Validator;

require_once(__DIR__.'/../resources/ExampleStruct.php');

/**
 * Tests for Struct container
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass  Indigo\Container\Struct
 */
class StructTest extends AbstractTest
{
    public function setUp()
    {
        $this->container = new \ExampleStruct;
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
