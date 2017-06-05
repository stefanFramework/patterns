<?php

class Singleton {
    
    static $instance = null ;
    
    private $counter;
    
    public function __construct() {
        $this->counter = 0;
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Singleton();
        } 
        
        return self::$instance;
    }
    
    public function inc() {
        $this->counter ++ ;
    }
    
    public function dec() {
        $this->counter --;
        
        if ($this->counter < 0) {
            $this->counter = 0;
        }
    }
    
    public function getCounter() {
        return $this->counter;
    }
}


echo "Creo Contador 1<br>";
$counter1 = Singleton::getInstance();

echo "Counter 1 = " . $counter1->getCounter() . "<hr>";

echo "Creo Contador 2<br>";
$counter2 = Singleton::getInstance();
echo "Counter 2 = " . $counter2->getCounter() . "<hr>";

echo "Incremento Contador 2<br>";
$counter2->inc(); 

echo "Counter 1 = " . $counter1->getCounter() . "<br>";
echo "Counter 2 = " . $counter2->getCounter() . "<br>";
