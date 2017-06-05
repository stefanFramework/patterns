<?php

/**
 * Strategy
 */
interface iElement {
    public function write($message);
}

class Span implements iElement {
    
    public function write($message) {
        echo htmlentities("<span>" . $message . "</span>");
    }
}

class Div implements iElement {
    public function write($message) {
        echo htmlentities("<div>" . $message . "</div>");
    }
}

class Paragraph implements iElement {
    public function write ($message) {
        echo htmlentities("<p>" . $message . "</p>");
    }
}

/**
 * Client
 */ 

class HtmlGenerator {
    public $message;
    
    public function generate(iElement $mode) {
        $mode->write($this->message);
    }
}

/**
 * Use
 */

$html = new HtmlGenerator();
$html->message = "Esto es una prueba";

$html->generate(new Span());
echo "<hr>";

$html->generate(new Div());
echo "<hr>";

$html->generate(new Paragraph());
