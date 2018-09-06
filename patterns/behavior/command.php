<?php

/**
 * Reciever
 */
interface ElectronicDevice
{
    public function on();
    public function off();
    public function volumeUp();
    public function volumeDown();
}

class Television implements ElectronicDevice
{
    private $volume;

    public function __construct()
    {
        $this->volume = 0;
    }

    public function on()
    {
        echo "Encendiendo la Tele";
    }

    public function off()
    {
        echo "Apagando la Tele";
    }

    public function volumeUp()
    {
        if ($this->volume < 100) {
            $this->volume ++;
        }

        echo "Volumen: " . $this->volume;

    }

    public function volumeDown()
    {
        if ($this->volume > 0) {
            $this->volume--;
        }

        echo "Volumen: " . $this->volume;
    }
}

/**
 * Comando
 */
interface Command
{
    public function execute();
}

class TurnTvOn implements Command
{
    private $electronicDevice;

    public function __construct(ElectronicDevice $electronicDevice)
    {
        $this->electronicDevice = $electronicDevice;
    }

    public function execute()
    {
        $this->electronicDevice->on();
    }
}

class TurnTvOff implements Command
{
    private $electronicDevice;

    public function __construct(ElectronicDevice $electronicDevice)
    {
        $this->electronicDevice = $electronicDevice;
    }

    public function execute()
    {
        $this->electronicDevice->off();
    }
}

class TurnVolumeUp implements Command
{
    private $electronicDevice;

    public function __construct(ElectronicDevice $electronicDevice)
    {
        $this->electronicDevice = $electronicDevice;
    }

    public function execute()
    {
        $this->electronicDevice->volumeUp();
    }
}

class TurnVolumeDown implements Command
{
    private $electronicDevice;

    public function __construct(ElectronicDevice $electronicDevice)
    {
        $this->electronicDevice = $electronicDevice;
    }

    public function execute()
    {
        $this->electronicDevice->volumeDown();
    }
}

/**
 * Invoker
 * Este invoker no sabe que device o comando esta siendo usado,
 * simplemente ejecuta un comando
 *
 */
class DeviceButton {
    private $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function press()
    {
        $this->command->execute();

    }
}

// Main
$tv = new Television();

$turnTVOn = new TurnTvOn($tv);
$turnTVOff = new TurnTvOff($tv);
$turnVolumeUp = new TurnVolumeUp($tv);
$turnVolumeDown = new TurnVolumeDown($tv);

$button = new DeviceButton($turnTVOn);
$button->press();