<?php

/*
 * This file is part of the Indigo Container package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Fuel\Common\DataContainer;

class HelperContainer extends DataContainer implements Serializable
{
    use \Indigo\Container\Helper\Serializable;
    use \Indigo\Container\Helper\Reset;
    use \Indigo\Container\Helper\Insert;
    use \Indigo\Container\Helper\Id;

    protected $ignoreKeys = ['test'];
}
