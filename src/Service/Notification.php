<?php

namespace Bcash\Service;

use Bcash\Service\Consultation;

class Notification implements IEnvironmentManager
{
	private $email;
	private $token;
	private $id_transacao;
	private $pedido;
	private $status;
	private $transaction;
	private $sandBox;

	/**
	 * @param email
	 *           Email da conta do lojista no bcash para autenticação.
	 * @param token
	 *           Token da conta do lojista no bcash para autenticação. 
	 * @param Array notificationContent
	 *           Conteúdo recebido na notificação
	 */
	public function __construct($email, $token, $notificationContent = array())
	{
		$this->email = $email;
		$this->token = $token;

		if (empty($notificationContent)) {
			$notificationContent = $_POST;
		}

		$this->sandBox = false;
		$this->id_transacao = $notificationContent['transacao_id'];
		$this->pedido = $notificationContent['pedido'];
		$this->status = $notificationContent['status'];
	}

	/**
	 * Valida a notificação recebida
	 * @param transactionValue
	 *           Soma de todos os produtos + frete + acrescimos - descontos.
	 * @return boolean indicando se a notificação é ou não válida.
	 */
	public function verify($transactionValue)
	{
		$this->recoverTransaction();

		if (!$this->compareStatus()) {
			return false;
		}

		if (!$this->compareValue($transactionValue)) {
			return false;
		}

		return true;
	}

	private function compareValue($value)
	{
		$consultado = $this->transaction->valor_original;
		return $consultado == $value;
	}

	private function compareStatus() 
	{
		$consultado = $this->transaction->status;
		$recebido = $this->status;
		return $consultado == $recebido;
	}

	private function recoverTransaction() 
	{
		if (!empty($transaction)){
			return;
		}

		$consultation = new Consultation($this->email, $this->token);
		$consultation->enableSandBox($this->sandBox);
		$this->transaction = $consultation->searchByTransaction($this->id_transacao);
		$this->transaction = $this->transaction->transacao;
	}

	public function enableSandBox($bool)
	{
		if ($bool) {
			$this->sandBox = true;
		}
	}

}
