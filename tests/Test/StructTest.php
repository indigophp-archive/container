<?php

namespace Indigo\Container\Test;

use Indigo\Container\Struct;
use Fuel\Validation\Validator;

require_once(__DIR__.'/../ExampleStruct.php');

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
        $this->container = new \ExampleStruct;
    }

    /**
     * @covers ::__construct
     * @covers ::createValidator
     * @covers ::populateValidator
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new \ExampleStruct(
            array(
                'email' => 'user@example.com'
            )
        );
    }
}
