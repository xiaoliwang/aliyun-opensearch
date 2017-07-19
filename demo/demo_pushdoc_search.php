<?php
header("Content-Type:text/html;charset=utf-8");
//引用头部文件
require_once("Config.inc.php");
use OpenSearch\Client\DocumentClient;
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;

//设置数据需推送到表名
$tableName = '替换为应用表名';
//创建文档操作client
$documentClient = new DocumentClient($client);
//添加数据
$docs_to_upload = array();
for ($i = 0; $i < 10; $i++){
    $item = array();
    $item['cmd'] = 'ADD';
    $item["fields"] = array(
		"id" => $i + 1,
        "name" => "搜索肯德基".$i
		);
    $docs_to_upload[] = $item;
}
// 编码
$json = json_encode($docs_to_upload);
//提交推送文档
$ret = $documentClient->push($json, $appName, $tableName);

//延迟10秒，高级版主表增量90%，10秒内生效，99%在10min内，附表暂不保证。
sleep(10); 

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