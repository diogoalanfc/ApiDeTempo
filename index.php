
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$baseUrl = 'http://api.openweathermap.org';
$appid = '91053a894f38e61bf8173867de57bf7f';
$id = '3468879';
$client = new Client(array('base_uri' => $baseUrl));
$response = $client->get('/data/2.5/weather', array(
    'query' => array('appid' => $appid, 'id' => $id)
        ));
print_r($response->getBody());
?>
