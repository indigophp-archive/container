<?php

namespace Indigo\Container;

use Fuel\Validation\Validator;
use Fuel\Common\DataContainer;

/**
 * Tests for Validation container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Validation
 */
class ValidationTest extends AbstractTest
{
    protected $validator;

    public function _before()
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
     * @group  Container
     */
    public function testConstruct()
    {
        $data = [
            'email' => 'email@domain.com',
            'name' => 'test'
        ];

        $container = new Validation($this->validator, $data, true);

        $this->assertEquals($data, $container->getContents());
        $this->assertTrue($container->isReadOnly());
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
            $this->container->setValidator(new Validator)
        );
    }

    /**
     * @covers ::set
     * @covers ::validateOne
     * @group  Container
     */
    public function testSet()
    {
        $this->container->set('name', 'test');

        $this->assertEquals('test', $this->container->get('name'));
    }

    /**
     * @covers            ::set
     * @covers            ::validateOne
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
        $this->container->merge([
            'name'  => 'test',
            'email' => 'email@domain.com',
        ]);

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
            ['email' => 123],
            new DataContainer(['email' => 'user2@example'])
        );
    }
}
