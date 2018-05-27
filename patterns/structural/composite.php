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

class Client
{
    /** @var Folder  */
    private $myDocumentsFolder;

    public function __construct()
    {
        $this->myDocumentsFolder = new Folder();
    }

    public function addFileToMyDocuments(File $newFile)
    {
        $this->myDocumentsFolder->addElement($newFile);
    }

    public function getMyDocumentsSize()
    {
        echo "La Carpeta Mis Documentos pesa " . $this->myDocumentsFolder->getSize() . " bytes<hr>";
    }

    public function getFileSize(File $file)
    {
        echo "El archivo pesa " . $file->getSize() . " bytes<hr>";
    }

}

$file1 = new File();
$file1->content = "Esto es un archivo txt";

$file2 = new File();
$file2->content = "Esto es otro archivo txt, distinto al anterior";

$file3 = new File();
$file3->content = "Esto es un archivo XLS";

$systemUser = new Client();
$systemUser->addFileToMyDocuments($file1);
$systemUser->addFileToMyDocuments($file2);
$systemUser->addFileToMyDocuments($file3);

$systemUser->getFileSize($file1);
$systemUser->getMyDocumentsSize();
