<?php

/**
 * Strategy
 */
interface iElement {
    public function write($message);
}

class Span implements iStyle {
    
    public function write($message) {
        echo "<span>" . $message . "</span>";
    }
}

class Div implements iStyle {
    public function write($message) {
        echo "<div>" . $message . "</div>";
    }
}

class Paragraph implements iStyle {
    public function write ($message) {
        echo "<p>" . $message . "</p>";
    }
}

/**
 * Client
 */ 

class HtmlGenerator {
    public $message;
    
    public function generate(iStyle $mode) {
        $mode->write($this->message);
    }
}

/**
 * Use
 */

$html = new HtmlGenerator();
$html->message = "Esto es una prueba";

$html->generate(new Span());
$html->generate(new Div());
$html->generate(new Paragraph());

