<?php

use Fuel\Common\DataContainer;

class SerializableContainer extends DataContainer implements Serializable
{
    use Indigo\Container\Serializable;
}
