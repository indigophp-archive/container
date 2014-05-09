<?php

use Fuel\Common\DataContainer;

class HelperContainer extends DataContainer implements Serializable
{
    use \Indigo\Container\Helper\Serializable;
    use \Indigo\Container\Helper\Reset;
    use \Indigo\Container\Helper\Insert;
}
