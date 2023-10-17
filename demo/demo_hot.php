<?php
//require_once("../OpenSearch/Autoloader/Autoloader.php");
require_once "Config.inc.php";
use OpenSearch\Client\OpenSearchClient;
$accessKeyId = '<替换为 AK >';
$secret = '<替换为 AK secret>';
$endPoint = '<替换为 endpoint>';
$appName = '<替换为 应用名称>';
$options = array('debug' => true);
$modelName = '<替换为 热搜模型名称>';
$client = new OpenSearchClient($accessKeyId, $secret, $endPoint, $options);
$uri = "/apps/{$appName}/actions/hot";
$params = [];
$params['hit'] = 10;
$params['sort_type'] = 'default';
$params['user_id'] = '1231453';
$params['model_name'] = $modelName;
try{
    $ret = $client->get($uri, $params);
    print_r(json_decode($ret->result, true));
}catch (\Throwable $e) {
    print_r($e);
}