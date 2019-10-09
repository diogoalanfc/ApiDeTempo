
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

$baseUrl = 'http://api.openweathermap.org';
$appid = '91053a894f38e61bf8173867de57bf7f';
$id = '3468879';

//Recupera a data de criação  dos dados
$dataCriacao = file_get_contents('cache/validade_tempo.txt');

//300 = 5minutos
if (time() - $dataCriacao>=300){

try{
$client = new Client(array('base_uri' => $baseUrl));
$response = $client->get('/data/2.5/weather', array(
    'query' => array('appid' => $appid, 'id' => $id)
        ));

$tempo = json_decode($response->getBody());
$dadosSerializados = serialize($tempo);
file_put_contents('cache/dados_tempo.txt', $dadosSerializados);
file_put_contents('cache/validade_tempo.txt', time());

} catch (ClientException $e){
    echo 'Falha ao obter imformações';
}
} else {
    
    $dadosSerializados = file_get_contents('cache/dados_tempo.txt');
    $tempo = unserialize($dadosSerializados);
}
echo 'Temperatura: ', $tempo->main->temp - 273;
echo '<br/>';
echo 'Pressão: ', $tempo->main->pressure;
echo '<br/>';
echo 'Umidade: ', $tempo->main->humidity;
echo '<br/>';
echo 'Temperatura mínima: ', $tempo->main->temp_min - 273;
echo '<br/>';
echo 'Temperatura máxima: ', $tempo->main->temp_max - 273;
?>
