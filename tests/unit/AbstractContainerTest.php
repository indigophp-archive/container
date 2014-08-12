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

use Codeception\TestCase\Test;

/**
 * Tests for Containers
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class AbstractContainerTest extends Test
{
    /**
     * @var Fuel\Common\DataContainer
     */
    protected $container;
}
