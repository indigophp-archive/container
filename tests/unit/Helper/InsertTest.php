<?php

namespace Indigo\Container\Helper;

use Indigo\Container\AbstractTest;

/**
 * Tests for Insert trait
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * @coversDefaultClass Indigo\Container\Helper\Insert
 */
class InsertTest extends AbstractTest
{
    public function _before()
    {
        $this->container = new \HelperContainer();
    }

    /**
     * @covers ::insertAssoc
     * @group  Container
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
     * @group  Container
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
     * @group             Container
     */
    public function testInsertAssocFailure()
    {
        $this->container->setReadOnly();
        $this->container->insertAssoc('key0', 'value0', 1);
        $this->container->insert('value1', 1);
    }
}
