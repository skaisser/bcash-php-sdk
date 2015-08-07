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
	const paymentHost = "http://localhost:8080/service/createTransaction/json";
	const paymentVersion = "1.0";
	
	const accountHost = "http://localhost:8080/service/searchAccount/json";
	const accountVersion = "1.0";
	
	const charset =  "UTF-8"; // UTF-8 or ISO-8859-1
	const timeout = 20;
}
