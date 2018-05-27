<?php

interface iCoffee
{
    public function getBaseCost();
}

class Coffee implements iCoffee
{

    protected $baseCost = 0;

    public function getBaseCost()
    {
        return $this->baseCost;
    }

}

class BlackCoffee extends Coffee
{

    public function __construct()
    {
        $this->baseCost = 5;
    }

}

class Capuccino extends Coffee
{
    public function __construct()
    {
        $this->baseCost = 15;
    }
}

abstract class CoffeeDecorator implements iCoffee
{

    protected $coffee;

    public function __construct(iCoffee $Coffee)
    {
        $this->coffee = $Coffee;
    }

}

class Cream extends CoffeeDecorator
{

    public function getBaseCost()
    {
        return $this->coffee->getBaseCost() + 1.5;
    }

}

class Milk extends CoffeeDecorator
{

    public function getBaseCost()
    {
        return $this->coffee->getBaseCost() + 4;
    }

}

class Chocolate extends CoffeeDecorator
{

    public function getBaseCost()
    {
        return $this->coffee->getBaseCost() + 5;
    }

}

$coffee = new Chocolate(new Milk(new Cream(new BlackCoffee())));
echo 'El precio del cafe es: $' . $coffee->getBaseCost();
