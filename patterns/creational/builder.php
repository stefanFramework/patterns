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
    public function makeBurger(BurgerBuilder $builder)
    {
        $builder->createBurger();
        $builder->prepareBun();
        $builder->cookPatty();
        $builder->putToppings();

        return $builder->getBurger();
    }
}


$chef = new Chef();
$vegieBurger = $chef->makeBurger(new VeggieBurgerBuilder());
echo $vegieBurger;
echo "<hr>";
$americanBurger = $chef->makeBurger(new AmericanBurgerBuilder());
echo $americanBurger;
