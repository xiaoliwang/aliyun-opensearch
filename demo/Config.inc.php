<?php
//引入头文件
require_once("../OpenSearch/Autoloader/Autoloader.php");
use OpenSearch\Client\OpenSearchClient;

//替换对应的access key id
$accessKeyId = '<Your accessKeyId>';
//替换对应的access secret
$secret = '<Your secret>';
//替换为对应区域api访问地址，可参考应用控制台,基本信息中api地址
$endPoint = '<region endPoint>';
//替换为应用名
$appName = '<app name>';
//替换为下拉提示名称
$suggestName = '<suggest name>';
//开启调试模式
$options = array('debug' => true);
//创建OpenSearchClient客户端对象
$client = new OpenSearchClient($accessKeyId, $secret, $endPoint, $options);