<?php

/**
 * Detailed endpoint documentation
 * https://dev.efipay.com.br/docs/APICobrancas/Cartao#listar-parcelas-de-acordo-com-a-bandeira-do-cart%C3%A3o
 */

$autoload = realpath(__DIR__ . "/../../../vendor/autoload.php");
if (!file_exists($autoload)) {
    die("Autoload file not found or on path <code>$autoload</code>.");
}
require_once $autoload;

use Efi\Exception\EfiException;
use Efi\EfiPay;

$options = __DIR__ . "/../../credentials/options.php";
if (!file_exists($options)) {
	die("Options file not found or on path <code>$options</code>.");
}
require $options;

$params = [
	"total" => "20000",
	"brand" => "visa" // "mastercard", "amex", "elo", hipercard
];

try {
	$api = new EfiPay($options);
	$response = $api->getInstallments($params);

	print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");
} catch (EfiException $e) {
	print_r($e->code . "<br>");
	print_r($e->error . "<br>");
	print_r($e->errorDescription) . "<br>";
} catch (Exception $e) {
	print_r($e->getMessage());
}