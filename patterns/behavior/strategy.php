<?php

interface iStyle
{
    public function apply($text);
}

class Bold implements  iStyle
{
    public function apply($text)
    {
        echo "<b>" . $text . "</b>";
    }
}

class Italics implements iStyle
{
    public function apply($text)
    {
        echo "<i>" . $text . "</i>";
    }
}

class TextWriter
{
    public function write($text, iStyle $style)
    {
        $style->apply($text);
    }
}

// =====================================================================
$writer = new TextWriter();
$writer->write("Esto es un texto en Negrita", new Bold());
echo "<hr>";
$writer->write("Esto es un texto en Cursiva", new Italics());