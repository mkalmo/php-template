<?php

class TextNode extends AbstractNode {

    private $text;

    public function __construct($text) {
        $this->text = $text;
    }

    public function render($scope) {
        var_dump($scope);

        return $scope->replaceCurlyExpression($this->text);
    }

}
