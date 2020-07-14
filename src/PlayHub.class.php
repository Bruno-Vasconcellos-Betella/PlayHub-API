<?php



/**
 * @var $ApiKey string chave de API
 * @var $ApiSecret string senha de API
 * @var $prefixUrl string começo da URL do HOST.
 */
class PlayHub{
	

	// protected $token = '';

	protected $prefixUrl = 'https://stage3.pca.com.br/playhub_demo/API/PlayhubApi/';
	protected $ApiKey = 'Sua chave';
	protected $ApiSecret = 'Sua Senha';
	
	public function getToken(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->prefixUrl."api/v1/authentication/tokens");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('ApiKey' => $this->ApiKey, 'ApiSecret' => $this->ApiSecret)));
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$result = array('status' => $httpcode, 'return' => json_decode($response));
		return $result;
	}
}

?>