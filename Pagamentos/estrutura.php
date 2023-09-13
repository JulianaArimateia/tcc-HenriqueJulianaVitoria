<?php

require 'vendor/autoload.php'; // Carrega a SDK do Mercado Pago

MercadoPago\SDK::setAccessToken("SEU_ACCESS_TOKEN");


$payment = new MercadoPago\Payment();
$payment->transaction_amount = 100;

$payment->payer = array (
    "email" => "comprador@example.com"
);

$payment->payment_method_id = "pix";
$payment->external_reference = "SEU_REFERENCIA_EXTERNA";


$payment->save();

$copia_e_cola  =  $payment->point_or_interaction->transaction_data->qr_code;
$ticket_url    =  $payment->point_or_interaction->transaction_data->ticket_url;
$img_qrcode    =  'data:image/png;base64,'.$payment->point_or_interaction->transaction_data->qr_code_base64;

echo '<img width="300" src="'.$img_qrcode.'">';
die;

echo '<pre>';
var_dump($payment)

?>
    
