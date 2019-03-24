<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/models/CheckResponse.php';

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;
use React\Http\Server;


$loop = React\EventLoop\Factory::create();

$server = new Server(function (ServerRequestInterface $request) {
	$path = str_replace('/v1', '', $request->getUri()->getPath());
	$method = $request->getMethod();

	if ($path === '/') {
		return new Response(200, ['Content-Type' => 'text/plain'],  '<h3>RESTful only</h3>');
	}

	if ($path === '/check' && $method === 'POST') {
		// First step: Analyze the request data from the client
		$data = json_decode($request->getBody(), true);

		// Check what server is able to offer

		$checkResponse = new CheckResponse();
		$checkResponse->setFullfillable(true);
		$checkResponse->addComponent('PHP', '7.2.3');
		$checkResponse->addComponent('MySQL', '5.7.5');
		$checkResponse->addComponent('php_gd', '7.2.3');


		// Return list of proposed changes
		return new Response(200, ['Content-Type' => 'text/json'],  json_encode($checkResponse));
	}

	if ($path === '/change' && $method === 'POST') {

	}

	if ($path === '/rollback' && $method === 'POST') {

	}

	if ($path === '/status' && $method === 'GET') {

	}

	$response = new stdClass;

	$response->code = 405;
	$response->msg = "Error, invalid command";

	return new Response(404, ['Content-Type' => 'text/json'],  json_encode($response));

});

$socket = new React\Socket\Server(8080, $loop);
$server->listen($socket);

$loop->run();
