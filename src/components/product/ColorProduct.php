<?php

namespace components\product;

class ColorProduct extends Product
{

    private $color;

    function getColor()
    {
        return $this->color;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function __toString()
    {
        return parent::__toString() . ' ' . $this->getColor();
    }
}
