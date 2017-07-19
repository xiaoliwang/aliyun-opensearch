<?php
header("Content-Type:text/html;charset=utf-8");
//引用头部文件
require_once("Config.inc.php");
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;
// 实例化一个搜索类
$searchClient = new SearchClient($client);
// 实例化一个搜索参数类
$params = new SearchParamsBuilder();
//设置config子句的start值
$params->setStart(0);
//设置config子句的hit值
$params->setHits(20);
// 指定一个应用用于搜索
$params->setAppName('替换为应用名');
// 指定搜索关键词
$params->setQuery("name:'搜索'");
// 指定返回的搜索结果的格式为json
$params->setFormat("fulljson");
//添加排序字段
$params->addSort('RANK', SearchParamsBuilder::SORT_DECREASE);
// 执行搜索，获取搜索结果
$ret = $searchClient->execute($params->build());
// 将json类型字符串解码
print_r(json_decode($ret->result,true));
//打印调试信息
echo $ret->traceInfo->tracer;