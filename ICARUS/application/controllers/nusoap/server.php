<?php
require_once('lib/nusoap.php');
$ns = 'http://localhost/nusoap';

$server = new soap_server();
$server->configureWSDL('CanadaTaxCalculator');
$server->wsdl->schemaTargetNamespace = $ns;

$server->register(
			'CalculateOntarioTax',
			array('amount' => 'xsd:double'),
			array('return' => 'xsd:string'),
			$ns,
			false,
			'rpc',
			'encoded',
			'Calculate the taxes for a given ammount.');

function CalculateOntarioTax($amount)
{
	$taxcalc = $amount * 2;
	return new soapval('return', 'string', $taxcalc);
}

// Get our posted data if the service is being consumed
// otherwise leave this data blank.                
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) 
                ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
                
$server->service($POST_DATA);
?>