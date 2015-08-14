<?php

namespace Bcash\Test;

use Bcash\Http\PostRequest;
use Bcash\Http\Connection;
use Bcash\Helper\HttpHelper;
use Bcash\Config\Config;

/**
 * Classe para simular a notificação do bcash.
 *
 */
class NotificationSimulator
{
	public static function test($urlAviso, $id_transacao, $id_pedido, $id_status)
	{
		$request = new PostRequest($urlAviso);
		$parameters = array("transacao_id" => $id_transacao, "pedido" => $id_pedido, "status" => $id_status);
		$request->setContent(HttpHelper::toQueryString($parameters));

		$response = self::send($request);
		return $response;
	}

	private static function send($request)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $request->getUrl());
		curl_setopt($ch, CURLOPT_POST, count($request->getContent()));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request->getContent());
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, Config::timeout);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

}
