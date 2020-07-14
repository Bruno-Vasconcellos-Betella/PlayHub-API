# PlayHub-API


Para usar use adicione a linha abaixo:
require_once('src/autoload.php');



## TESTE newClinente() ##
$cliente = new Clientes();
$dados['username'] = 'assinante1';
$dados['document'] = '99999999999';
$dados['password'] = 'Um@s3nh@';
$dados['name'] = 'Cliente Teste';
$dados = (object)$dados;
$test = $cliente->newCliente($dados);
var_dump($test);
#########################################


## TESTE attClinente() ##
$cliente = new Clientes();
$dados['username'] = 'assinante';
$dados['document'] = '99999999999';
$dados['password'] = 'Um@s3nh@2';
$dados['name'] = 'Cliente Teste atualizado';
$dados = (object)$dados;
$test = $cliente->attCliente($dados->username, $dados);
var_dump($test);
#########################################


## TESTE getClinente() ##
$cliente = new Clientes;
$teste = $cliente->getCliente('assinante');
var_dump($teste);


#############################################################################


## TESTE addAssinatura() ##
$assinatura = new Assinaturas();
$username = 'assinante';
$productId = 'NGG';
$test = $assinatura->addAssinatura($username, $productId);
var_dump($test);
#########################################




## TESTE getAssinatura() ##
$assinatura = new Assinaturas;
$username = 'assinante';
$teste = $assinatura->getAssinatura($username);
var_dump($teste);
#########################################



## TESTE removeAssinatura() ##
$assinatura = new Assinaturas();
$username = 'assinante';
$productId = 'NGG';
$test = $assinatura->removeAssinatura($username, $productId);
var_dump($test);
#########################################




