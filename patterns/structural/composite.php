<?php

// File System Element
abstract class FsElement {
    public $content;
    
    public function getSize() { }
}

class File extends FsElement {
    public function getSize() {
        return strlen($this->content);
    }
}

class Folder extends FsElement {
    private $elements = array (); 
    
    public function addElement(FsElement $element) {
        array_push($this->elements, $element);
    }
    
    public function getSize() {
        $total = 0;
        foreach ($this->elements as  $element) {
            $total += $element->getSize();
        }
        
        return $total;
    }
}


$file1 = new File();
$file1->content = "Esto es un archivo txt";

$file2 = new File();
$file2->content = "Esto es otro archivo txt, distinto al anterior";

$file3 = new File();
$file3->content = "Esto es un archivo XLS";

$myDocuments = new Folder();
$myDocuments->addElement($file1);
$myDocuments->addElement($file2);
$myDocuments->addElement($file3);

echo "El archivo1 pesa " . $file1->getSize() . " bytes<hr>";
echo "La Carpeta Mis Documentos pesa " . $myDocuments->getSize() . " bytes<hr>";
