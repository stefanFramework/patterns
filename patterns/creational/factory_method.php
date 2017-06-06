<?php

// Products
// =============================================================================
abstract class Car {

    public $model;
    public $engine;
    public $hasAbs;
    public $numberOfAirbags;
    public $color;

}

class FordFiesta extends Car {

    public function __construct($color) {
        $this->model = "Ford Fiesta";
        $this->engine = "1.6";
        $this->hasAbs = true;
        $this->numberOfAirbags = 4;
        $this->color = $color;
    }

}

class GolTrend extends Car {

    public function __construct($color) {
        $this->model = "Gol Trend";
        $this->engine = "1.4";
        $this->hasAbs = true;
        $this->numberOfAirbags = 2;
        $this->color = $color;
    }

}

class RenaultMegane extends Car {

    public function __construct($color) {
        $this->model = "Renault Megane";
        $this->engine = "2.0";
        $this->hasAbs = true;
        $this->numberOfAirbags = 6;
        $this->color = $color;
    }

}


// Factories 
// =============================================================================


interface iCarFactory {
    public static function createCar($color);
}

class FordFiestaFactory implements iCarFactory {
    public static function createCar($color) {
        return new FordFiesta($color);
    }
}


class GolTrendFactory implements iCarFactory {
    public static function createCar($color) {
        return new GolTrend($color);
    }
}


class RenaultMeganeFactory implements iCarFactory {
    public static function createCar($color) {
        return new RenaultMegane($color);
    }
}


// Use
// =============================================================================

$fordFiesta = FordFiestaFactory::createCar("Blanco");
$golTrend = GolTrendFactory::createCar("Negro");
$golAzul = GolTrendFactory::createCar("Azul");

echo "Este es un $fordFiesta->model color  $fordFiesta->color <br>";
echo "Este es un $golTrend->model color  $golTrend->color <br>";
echo "Este es un $golAzul->model color  $golAzul->color <br>";
