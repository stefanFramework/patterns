<?php

// Command
interface iRuleCommand
{
    public function execute($value);
}

class RequiredCommand implements iRuleCommand
{
    public function execute($value)
    {
        return !empty($value);
    }
}

class IsNumericCommand implements iRuleCommand
{
    public function execute($value)
    {
        $regex = "/^[0-9]+$/i";
        return preg_match($regex, $value);
    }
}


// Invoker
class Invoker
{
    private $ruleCommand;

    public function __construct(iRuleCommand $ruleCommand)
    {
        $this->ruleCommand = $ruleCommand;
    }

    public function run($context)
    {
        return $this->ruleCommand->execute($context);
    }
}

// Receiver
class Validator
{
    /** @var Invoker */
    private $invoker;

    public function setRule(iRuleCommand $ruleCommand)
    {
        $this->invoker = new Invoker($ruleCommand);
    }

    public function isValid($value)
    {
        return $this->invoker->run($value);
    }
}


// Client
$validator = new Validator();
$validator->setRule(new RequiredCommand());

if ($validator->isValid("")) {
    echo "Paso la prueba";
} else {
    echo "No paso la prueba";
}
