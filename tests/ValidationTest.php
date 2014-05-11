<?php

namespace Indigo\Container\Test;

use Indigo\Container\Validation;
use Fuel\Validation\Validator;
use Fuel\Common\DataContainer;

/**
 * Tests for Validation container
 *
 * @author  Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass  Indigo\Container\Validation
 */
class ValidationTest extends AbstractTest
{
    protected $validator;

    public function setUp()
    {
        $this->validator = new Validator;

        $this->container = new Validation($this->validator);

        $this->populateValidator($this->validator);
    }

    public function populateValidator(Validator $validator)
    {
        $validator->addField('email', 'Email')
            ->required()
            ->email();

        $validator->addField('name', 'Name')
            ->minLength(1);
    }

    /**
     * @covers ::__construct
     * @covers ::validate
     * @group  Container
     */
    public function testConstruct()
    {
        $container = new Validation(
            $this->validator,
            array(
                'email' => 'user@example.com'
            )
        );
    }

    /**
     * @covers            ::__construct
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testConstructFailure()
    {
        $container = new Validation(
            $this->validator,
            array(
                'email' => 'user@example'
            )
        );
    }

    /**
     * @covers ::getValidator
     * @covers ::setValidator
     * @group  Container
     */
    public function testGetSetValidator()
    {
        $validator = $this->container->getValidator();

        $this->assertSame($this->validator, $validator);

        $this->assertSame(
            $this->container,
            $this->container->setValidator($validator)
        );
    }

    /**
     * @covers ::set
     * @covers ::validate
     * @group  Container
     */
    public function testSet()
    {
        $this->container->set('name', 'test');

        $this->assertEquals('test', $this->container->get('name'));
    }

    /**
     * @covers            ::set
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     * @group             Container
     */
    public function testSetFailure()
    {
        $this->container->set('email', 123);
    }

    /**
     * @covers ::merge
     * @covers ::validate
     * @group  Container
     */
    public function testMerge()
    {
        $this->container->merge(array('name' => 'test'));

        $this->assertEquals('test', $this->container->get('name'));
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
            array('email' => 123),
            new DataContainer(array('email' => 'user2@example'))
        );
    }
}
