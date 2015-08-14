<?php

namespace Bcash\Service;

use Bcash\Service\IEnvironmentManager;
use Bcash\Http\GetRequest;
use Bcash\Config\Config;
use Bcash\Http\Authentication\Basic;
use Bcash\Helper\HttpHelper;
use Bcash\Http\Connection;

/**
 * Cliente para consulta de transações.
 *
 */
class Consultation implements IEnvironmentManager
{
	const route = "/report/customers/%s/transactions/%s";
	private $email;
	private $token;
	private $url;

	public function __construct($email, $token)
	{
		$this->email = $email;
		$this->token = $token;
		$this->url = Config::host . self::route;
	}

	/**
	 * Busca os dados da transação informada.
	 *
	 * @param id_transacao
	 *           Id da transação no Bcash a ser consultada.
	 * @return Objeto que contém informações da busca
	 */
	public function searchBy($id_transacao)
	{
		$request = $this->generateRequest($id_transacao);
		$response = $this->send($request);

		return HttpHelper::fromJson($response->getContent());
	}

	private function generateRequest($id_transacao)
	{
		$request = new GetRequest($this->url);

		$basic = new Basic();
		$request->addHeader($basic->generateHeader($this->email, $this->token));
		$request->addHeader("Content-Type:application/x-www-form-urlencoded;charset=" . Config::charset);

		$request->setUrl( vsprintf( $this->url, Array($this->email, $id_transacao) ) );

		return $request;
	}

	private function send($request)
	{
		$connection = new Connection(Config::timeout);
		$response = $connection->get($request);

		return $response;
	}

	public function enableSandBox($bool)
	{
		$this->url = Config::host . self::route;

		if ($bool) {
			$this->url = Config::hostSandBox .  self::route;
		}
	}

}
