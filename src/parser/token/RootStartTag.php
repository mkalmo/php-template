<?php

class RootStartTag extends RegexToken {

    public function getTagName() {
        return null;
    }

    public function __construct() {
        parent::__construct('<root>');
    }
}
