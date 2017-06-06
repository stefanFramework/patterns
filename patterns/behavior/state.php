<?php

// Client
//==============================================================================
class Ticket {
    public $date;
    public $movie;
    
    /**
     * @var iState 
     */
    public $state;
    
    public function __construct($movie) {
        $this->movie = $movie;
        $this->date = new DateTime("now");
        $this->state = new Free();
    }
    
    public function makeOperation() {
        $this->state->operate($this);
    }
}

// States
//==============================================================================
interface iState {
    public function operate(Ticket $ticket);
}

class Free implements iState {
    public function operate(Ticket $ticket) {
        $ticket->state = new Booked();
        echo "La entrada estaba <b>Libre</b>, y ahora paso a <b>Reservada</b><hr>";
    }
}

class Booked implements iState {
    public function operate(Ticket $ticket) {
        $ticket->state = new Used();
        echo "La entrada estaba <b>Reservada</b> y ahora paso a <b>Usada</b><hr>";
    }
}

class Used implements iState {
    public function operate(Ticket $ticket) {
        echo "Esta entrada ya fue utilizada, no se puede operar con esta entrada";
    }
}

// Use
//==============================================================================

$ticket = new Ticket("Lord of The Rings");
$ticket->makeOperation();
$ticket->makeOperation();
$ticket->makeOperation();
