<?php

namespace Models\Core;

class AbstractModel
{
    public $attr;
    public function getAttribute(string $attr){
        return $this->$attr;
    }

    public function setAttribute($attr, $value): void {
        $this->$attr = $value;
    }
}
