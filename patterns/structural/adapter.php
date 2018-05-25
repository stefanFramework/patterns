<?php

interface iPayPal
{
    public function pay($amount);
}

interface iEGateway
{
    public function sendNotification();
    public function makePayment($total);
}

class PayPalCash implements iPayPal
{
    public function pay($amount)
    {
        echo "Realizando pago a traves de PayPal por $" . $amount . "<hr>";
    }
}

class EGatewayCash implements iEGateway {
    public function makePayment($total)
    {
        echo "Realizando pago a traves de EGateway por $" . $total . "<br>";
    }

    public function sendNotification()
    {
        echo "Enviando notificacion a cliente<hr>";
    }
}

// Adaptadores
interface iEPaymentAdapter
{
    public function performPayment($amount);
}

class PayPalAdapter implements iEPaymentAdapter
{
    private $gateway;

    public function __construct(iPayPal $paypalGateway)
    {
        $this->gateway = $paypalGateway;
    }

    public function performPayment($amount)
    {
        $this->gateway->pay($amount);
    }
}

class EGatewayAdapter implements iEPaymentAdapter
{
    private $gateway;

    public function __construct(iEGateway $eGatewayAdapter)
    {
        $this->gateway = $eGatewayAdapter;
    }

    public function performPayment($amount)
    {
        $this->gateway->makePayment($amount);
        $this->gateway->sendNotification();
    }
}

class Client
{
    /** @var iEPaymentAdapter */
    private $gateway;

    public function setGateway(iEPaymentAdapter $gatewayAdapter)
    {
        $this->gateway = $gatewayAdapter;
    }

    public function payPurchase($total)
    {
        $this->gateway->performPayment($total);
    }
}


$client = new Client();
$client->setGateway(new PayPalAdapter(new PayPalCash()));
$client->payPurchase(100);

$client->setGateway(new EGatewayAdapter(new EGatewayCash()));
$client->payPurchase(200);