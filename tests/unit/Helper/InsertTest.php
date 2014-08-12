<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Container\Helper;

use Indigo\Container\AbstractContainerTest;

/**
 * Tests for Insert Helper
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Insert
 * @group              Container
 * @group              Helper
 */
class InsertTest extends AbstractContainerTest
{
    public function _before()
    {
        $this->container = new \HelperContainer();
    }

    /**
     * @covers ::insertAssoc
     */
    public function testInsertAssoc()
    {
        $this->assertEquals($this->container, $this->container->insertAssoc('key0', 'value0'));
        $this->container->insertAssoc('key2', 'value2');
        $this->assertEquals($this->container, $this->container->insertAssoc('key1', 'value1', 1));
        $this->container->insertAssoc('key3', 'value3', 15);

        for ($i=0; $i < 4; $i++) {
            $this->assertEquals('value'.$i, $this->container->get('key'.$i));
        }
    }

    /**
     * @covers ::insert
     * @covers ::insertAssoc
     */
    public function testInsert()
    {
        $this->assertEquals($this->container, $this->container->insert('value0'));
        $this->container->insert('value2');
        $this->assertEquals($this->container, $this->container->insert('value1', 1));
        $this->container->insert('value3', 15);

        $i = 0;

        foreach ($this->container->getContents() as $value) {
            $this->assertEquals('value'.$i, $value);

            $i++;
        }
    }

    /**
     * @covers            ::insertAssoc
     * @expectedException \RuntimeException
     */
    public function testInsertAssocFailure()
    {
        $this->container->setReadOnly();
        $this->container->insertAssoc('key0', 'value0', 1);
        $this->container->insert('value1', 1);
    }
}
