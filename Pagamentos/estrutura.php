<?php

require 'vendor/autoload.php'; // Carrega a SDK do Mercado Pago

MercadoPago\SDK::setAccessToken("SEU_ACCESS_TOKEN");


$preference = new MercadoPago\Preference();

$item           = new MercadoPago\Item();
$item->title    = 'Produto';
$item->quantity = 1;
$item->title    = 100;

$preference->items = array($item);
$preference->external_reference = 'EXTERNAL_REFERENCE';

$preference->payment_methods = array(
  "excluded_payment_types" => array(
    array(
        "id" => "ticket",
    )
    ),
);


$preference->notification_url  = 'http://localhost.net/mercadopago/notification.php';

    $preference->save();

    echo'<pre>';
    var_dump($preference->init_point);

?>
    
