<?php

require_once('nusoap/lib/nusoap.php');

class WebServices
{
	private $nameSpace;
	private $server;
	
	public function __construct()
	{
		$this->nameSpace = 'http://fastology.byethost3.com/icarus';
		$this->server = new soap_server();
		$this->server->configureWSDL('IcarusProject');
		$this->server->wsdl->schemaTargetNamespace = $this->nameSpace;
		$this->server->register(
			'WebServices.MultiplyByTwo',
			array('number' => 'xsd:double'),
			array('return' => 'xsd:double'),
			$this->nameSpace,
			false,
			'rpc',
			'encoded',
			'Calculate multiplication of a number by 2.');
	}
	
	public function MultiplyByTwo($number)
	{
		return $number * 2;
	}
	
	public function __destruct()
	{
		$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
                
		$this->server->service($POST_DATA);
	}
}

?>