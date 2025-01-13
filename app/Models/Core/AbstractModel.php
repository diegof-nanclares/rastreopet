<?php

namespace Models\Core;

abstract class AbstractModel
{
    public abstract function getAttribute(string $attr);

    public abstract function setAttribute($attr, $value);
}
