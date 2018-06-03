<?php

require_once('ExtendedTextCase.php');
require_once('../src/parser/node/Node.php');
require_once('../src/parser/node/TextNode.php');
require_once('../src/parser/node/IfNode.php');
require_once('../src/Scope.php');

class NodeTests extends ExtendedTestCase {

    function removesChildNode() {
        $parent = new AbstractNode('parent');

        $c1 = new AbstractNode('c1');
        $c2 = new AbstractNode('c2');

        $parent->addChild($c1);
        $parent->addChild($c2);

        $this->assertEqual([$c1, $c2], $parent->getChildren());

        $parent->removeChild($c1);

        $this->assertEqual([$c2], $parent->getChildren());
    }

    function addsNodeBeforeOtherNode() {
        $parent = new AbstractNode('parent');

        $c1 = new AbstractNode('c1');
        $c2 = new AbstractNode('c2');
        $new = new AbstractNode('new');

        $parent->addChild($c1);
        $parent->addChild($c2);

        $parent->insertBefore($new, $c2);

        $this->assertEqual([$c1, $new, $c2], $parent->getChildren());
    }

    function renderTextNode() {
        $node = new TextNode('1 {{ $var1 }}');
        $scope = new tpl\Scope(['$var1' => '2']);

        $this->assertEqual('1 2', $node->render($scope));
    }

    function _renderIfNode() {
        $node = new IfNode('<div tpl-if="$flag">');
        $node->addChild(new TextNode('text'));

        $scope = new tpl\Scope(['$flag' => true]);
        $this->assertEqual('<div>text</div>', $node->render($scope));

        $scope = new tpl\Scope(['$flag' => false]);
        $this->assertEqual('', $node->render($scope));
    }
}

(new NodeTests())->run(new TextReporter());