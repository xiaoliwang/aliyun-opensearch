<?php
//引用头文件
require_once("Config.inc.php");
use OpenSearch\Client\AppClient;
use OpenSearch\Generated\Common\Pageable;

//创建应用分页参数对象
$pageable = new Pageable(array('page' => 1, 'size' => 10));
//创建应用客户端
$appClient = new AppClient($client);
//查询并返回应用列表
$ret = $appClient->listAll($pageable);
//打印应用列表信息
print_r($ret);
//打印调试信息
echo $ret->traceInfo->tracer;