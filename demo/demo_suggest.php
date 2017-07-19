<?php
header("Content-Type:text/html;charset=utf-8");
//引用头部文件
require_once("Config.inc.php");
use OpenSearch\Client\SuggestClient;
use OpenSearch\Util\SuggestParamsBuilder;

//创建下拉提示client
$suggestClient = new SuggestClient($client);
//创建下拉提示参数对象
$params = SuggestParamsBuilder::build($appName, $suggestName, '搜索', 10);

//执行查询并返回下拉提示信息
$ret = $suggestClient->execute($params);
//打印返回消息
print_r(json_decode($ret->result, true));

//打印调试信息
echo $ret->traceInfo->tracer;