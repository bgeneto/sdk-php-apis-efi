<?php

/**
 * Detailed endpoint documentation
 * https://dev.efipay.com.br/docs/APICobrancas/Cartao#acrescentar-descri%C3%A7%C3%A3o-ao-hist%C3%B3rico-de-uma-transa%C3%A7%C3%A3o
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
	"id" => 0
];

$body = [
	"description" => "This billet is about a service"
];

try {
	$api = new EfiPay($options);
	$response = $api->createChargeHistory($params, $body);

	print_r("<pre>" . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "</pre>");
} catch (EfiException $e) {
	print_r($e->code . "<br>");
	print_r($e->error . "<br>");
	print_r($e->errorDescription) . "<br>";
} catch (Exception $e) {
	print_r($e->getMessage());
}