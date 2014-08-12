<?php

<<<<<<< HEAD:tests/unit/ValidationTest.php
=======
/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

>>>>>>> Drops in codeception:tests/unit/ValidationTest.php
namespace Indigo\Container;

use Fuel\Validation\Validator;
use Fuel\Common\DataContainer;

/**
 * Tests for Validation Container
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Validation
<<<<<<< HEAD:tests/unit/ValidationTest.php
=======
 * @group              Container
>>>>>>> Drops in codeception:tests/unit/ValidationTest.php
 */
class ValidationTest extends AbstractContainerTest
{
    protected $validator;

    public function _before()
    {
        $this->validator = new Validator;

        $this->container = new Validation($this->validator, [
            'email' => 'email@domain.com'
        ]);

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
<<<<<<< HEAD:tests/unit/ValidationTest.php
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
=======
>>>>>>> Drops in codeception:tests/unit/ValidationTest.php
     */
    public function testConstruct()
    {
        $container = new Validation($this->validator, [
            'email' => 'email@domain.com'
        ]);

        $this->assertSame($this->validator, $this->container->getValidator());
    }

    /**
     * @covers ::getValidator
     * @covers ::setValidator
     */
    public function testValidator()
    {
        $this->assertSame(
            $this->container,
<<<<<<< HEAD:tests/unit/ValidationTest.php
            $this->container->setValidator(new Validator)
=======
            $this->container->setValidator($this->validator)
>>>>>>> Drops in codeception:tests/unit/ValidationTest.php
        );

        $this->assertSame($this->validator, $this->container->getValidator());
    }

    /**
     * @covers ::set
     * @covers ::validateOne
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
     */
    public function testSetFailure()
    {
        $this->container->set('email', 123);
    }

    /**
     * @covers ::merge
     * @covers ::validate
     */
    public function testMerge()
    {
<<<<<<< HEAD:tests/unit/ValidationTest.php
        $this->container->merge([
            'name'  => 'test',
            'email' => 'email@domain.com',
        ]);
=======
        $this->container->merge(['name' => 'test']);
>>>>>>> Drops in codeception:tests/unit/ValidationTest.php

        $this->assertEquals('test', $this->container->get('name'));
    }

    /**
     * @covers            ::merge
     * @covers            ::validate
     * @expectedException InvalidArgumentException
     */
    public function testMergeFailure()
    {
        $this->container->merge(
            ['email' => 123],
            new DataContainer(['email' => 'user2@example'])
        );
    }
}
