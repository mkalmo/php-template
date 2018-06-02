<?php

abstract class AbstractActions {

    public abstract function tagStartAction($tagName, $attributes);

    public abstract function voidTagAction($tagName, $attributes);

    public abstract function tagEndAction($tagName);

    public abstract function staticElementAction($token);
}

