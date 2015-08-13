<?php

namespace Bcash\Config;
/**
 * Classe de configuração responsável por armazenar as informações de conexão do cliente com a API </br>
 * Responsável também por armazenar as configurações de utilização da API desejadas, como por exemplo a versão.
 *
 */
class Config
{
	#Api config
	const paymentHost = "https://api.bcash.com.br/service/createTransaction/json";
	const paymentHostSandBox = "https://sandbox-api.bcash.com.br/service/createTransaction/json";
	const paymentVersion = "1.0";
	
	const accountHost = "https://api.bcash.com.br/service/searchAccount/json";
	const accountHostSandBox = "https://sandbox-api.bcash.com.br/service/searchAccount/json";
	const accountVersion = "1.0";
	
	const installmentsHost = "https://api.bcash.com.br/service/seller/%s/installments";
	const installmentsHostSandBox = "https://ahmapi.bcash.com.br/service/seller/%s/installments";
	const installmentsVersion = "1.0";

	const charset =  "UTF-8"; // UTF-8 or ISO-8859-1
	const timeout = 20;
}
