<?php

require_once('PlayHub.class.php');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
/**
 * @author Bruno Vasoncellos Betella
 * @var String $token // Token de autenticação da API
 */
class Clientes extends PlayHub{
	
	protected $token;

	public function __construct(){
		$PlayHub = new PlayHub;
		$this->token = 'Bearer '.$PlayHub->getToken()['return']->AccessToken;
	}


	public function getCliente($username){

		/**
		* @param String $username // usuario do assinante
		* @return Array $result // retorno um array com os atributos (Int $status // HTTP code, Object return)
		*/

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/customers/".$username);
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


	public function attCliente($username, $dados){

		/**
		 * @param String $username // usuario de refencia
		 * @param Object $dados // com os atributos (String $password, String $name)
		 *
		 * @return Array $result // retorno um array com os atributos (Int $status, Object return)
		 */


		$body = array('Password' => $dados->password, 'Name' => $dados->name);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/customers/".$username);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$this->token));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);


		$result = array('status' => $httpcode, 'return' => json_decode($response));
		return $result;
	}



	public function newCliente($dados){

		/**
		* @param Object $dados com os atributos (String $username, String $document, String $password, String $name)
		* @return Array $result // retorno um array com os atributos (Int $status, Object return)
		*/

		$document = $dados->document;
		$document = str_replace('.', '', $document);
		$document = str_replace(',', '', $document);
		$document = str_replace('-', '', $document);
		$document = str_replace('/', '', $document);
		$document = str_replace('|', '', $document);
		$document = str_replace('"', '', $document);
		$document = str_replace("'", '', $document);
		$document = str_replace("(", '', $document);
		$document = str_replace(")", '', $document);

		$body = array('Username' => $dados->username, 'Document' => $document, 'Password' => $dados->password, 'Name' => $dados->name);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/customers/");
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



}


// ## TESTE newClinente() ##
// $cliente = new Clientes();
// $dados['username'] = 'assinante1';
// $dados['document'] = '99999999999';
// $dados['password'] = 'Um@s3nh@';
// $dados['name'] = 'Cliente Teste';
// $dados = (object)$dados;
// $test = $cliente->newCliente($dados);
// var_dump($test);
// #########################################


// ## TESTE attClinente() ##
// $cliente = new Clientes();
// $dados['username'] = 'assinante';
// $dados['document'] = '99999999999';
// $dados['password'] = 'Um@s3nh@2';
// $dados['name'] = 'Cliente Teste atualizado';
// $dados = (object)$dados;
// $test = $cliente->attCliente($dados->username, $dados);
// var_dump($test);
// #########################################


// ## TESTE getClinente() ##
// $cliente = new Clientes;
// $teste = $cliente->getCliente('assinante');
// var_dump($teste);




