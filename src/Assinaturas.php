<?php

require_once('PlayHub.class.php');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
/**
 * @author Bruno Vasoncellos Betella
 * @var String $token // Token de autenticação da API
 */
class Assinaturas extends PlayHub{
	
	protected $token;

	public function __construct(){
		$PlayHub = new PlayHub;
		$this->token = 'Bearer '.$PlayHub->getToken()['return']->AccessToken;
	}


	public function getAssinatura($username){

		/**
		* @param String $username // usuario do assinante
		* @return Array $result // retorno um array com os atributos (Int $status // HTTP code, Object return)
		*/

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/customers/".$username.'/subscriptions');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$this->token));
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$result = array('status' => $httpcode, 'return' => json_decode($response));
		return $result;

	}


	
	public function addAssinatura($username, $productId){

		/**
		* @param String $username // usuario de referencia
		* @param String $productId // Identificação da Assinatura
		* @return Array $result // retorno um array com os atributos (Int $status, Object return) 
		*/

		$body = array('ProductId' => $productId);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/customers/".$username."/subscriptions");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$this->token));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);
		$result = array('status' => $httpcode, 'return' => $response);
		return $result;
	}



	public function removeAssinatura($username, $productId){

		/**
		* @param String $username // usuario de referencia
		* @param String $productId // Identificação da Assinatura
		* @return Array $result // retorno um array com os atributos (Int $status, Object return)
		*/

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/customers/".$username."/subscriptions/".$productId);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$this->token));
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);
		$result = array('status' => $httpcode, 'return' => $response);
		return $result;
	}



}


## TESTE addAssinatura() ##
// $assinatura = new Assinaturas();
// $username = 'assinante';
// $productId = 'NGG';
// $test = $assinatura->addAssinatura($username, $productId);
// var_dump($test);
#########################################




## TESTE getAssinatura() ##
// $assinatura = new Assinaturas;
// $username = 'assinante';
// $teste = $assinatura->getAssinatura($username);
// var_dump($teste);
#########################################



## TESTE removeAssinatura() ##
// $assinatura = new Assinaturas();
// $username = 'assinante';
// $productId = 'NGG';
// $test = $assinatura->removeAssinatura($username, $productId);
// var_dump($test);
#########################################



