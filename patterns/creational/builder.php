<?php

class Burger
{
    private $patty;
    private $toppings = [];
    private $bun;

    public function __toString()
    {
        return json_encode([
            'patty' => $this->patty,
            'bun' => $this->bun,
            'toppings' => json_encode($this->toppings)
        ]);
    }

    public function setBun($bun)
    {
        $this->bun = $bun;
    }

    public function setPatty($patty)
    {
        $this->patty = $patty;
    }

    public function addToppings($toppings)
    {
        $this->toppings = $toppings;
    }
}

abstract class BurgerBuilder {
    /** @var Burger */
    protected $burger;

    public function createBurger()
    {
        $this->burger = new Burger();
    }

    public function getBurger()
    {
        return $this->burger;
    }

    abstract public function prepareBun();
    abstract public function cookPatty();
    abstract public function putToppings();
}

class VeggieBurgerBuilder extends BurgerBuilder
{
    public function prepareBun()
    {
        $this->burger->setBun('Pan de Sesamo');
    }

    public function cookPatty()
    {
        $this->burger->setPatty('Hamburguesa de Cereal');
    }

    public function putToppings()
    {
        $this->burger->addToppings(['tomate', 'cebolla']);
    }
}

class AmericanBurgerBuilder extends BurgerBuilder
{
    public function prepareBun()
    {
       $this->burger->setBun('Pan Tostado');
    }

    public function cookPatty()
    {
        $this->burger->setPatty('Beef');
    }

    public function putToppings()
    {
        $this->burger->addToppings(['queso', 'cebolla caramelizada', 'pepino', 'lechuga', 'huevo frito']);
    }
}

class Chef
{
    /** @var BurgerBuilder */
    private $builder;

    public function setBuilder (BurgerBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function makeBurger()
    {
        $this->builder->createBurger();
        $this->builder->prepareBun();
        $this->builder->cookPatty();
        $this->builder->putToppings();

        return $this->builder->getBurger();
    }
}


$chef = new Chef();

$chef->setBuilder(new VeggieBurgerBuilder());
echo $chef->makeBurger();

echo "<hr>";

$chef->setBuilder(new AmericanBurgerBuilder());
echo $chef->makeBurger();;
