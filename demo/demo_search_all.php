<?php
header("Content-Type:text/html;charset=utf-8");
//引入头文件
require_once("Config.inc.php");
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;

$searchClient = new SearchClient($client);
//创建参数对象，并指定对应参数
$params = new SearchParamsBuilder();
$params->setStart(0);
$params->setHits(20);

//设置参与精排个数，不设置默认200
//$params->setReRankSize(200);

//设置应用名称
$params->setAppName('替换为应用名');
//设置查询query
$params->setQuery("name:'搜索'");
//设置返回格式
$params->setFormat("fulljson");
//添加排序
$params->addSort('id', SearchParamsBuilder::SORT_DECREASE);
$params->addSort('RANK', SearchParamsBuilder::SORT_DECREASE);
//设置文档过滤条件
$params->setFilter('id>0');


//添加distinct子句
$params->addDistinct(
    array('key' => 'cate_id', 'distTimes' => 1, 'distCount' => 2, 'reserved' => 'false')
);


//添加kvpairs子句
//$params->setKvPairs("duniqfield:cate_id");

//添加摘要
$params->addSummary(
    array('summary_field' => 'name', 'summary_len' => 100, 'summary_ellipsis' => "。。。", 'summary_snippet' => 2, 'summary_element_prefix' => '<em>', 'summary_element_postfix' => '</em>')
);
//$params->addSummary(
//    array('summary_field' => 'name', 'summary_len' => 200)
//);

//设置自定义参数
//$params->setCustomParam('a', 'b');
//$params->setCustomParam('c', 'd');
//$params->setRouteValue('1');

//添加aggregate子句
 $params->addAggregate(
     array('groupKey' => 'cate_id', 'aggFun' => 'count()', 'range' => '1', 'aggSamplerThresHold' => 1, 'aggSamplerStep' => 10, 'maxGroup' => 10)
 );
// $params->addAggregate(
//     array('groupKey' => 'cate_id', 'aggFun' => 'count()', 'range' => '1', 'aggFilter' => 'id>1', 'aggSamplerThresHold' => 1, 'aggSamplerStep' => 10, 'maxGroup' => 10)
// );

//指定粗排表达式
$params->setFirstRankName('default');
//指定精排表达式
$params->setSecondRankName('default');
//设置需返回哪些字段
$params->setFetchFields(array('id','name','phone','int_arr','literal_arr','float_arr','cate_id'));

//添加查询分析功能
$params->addQueryProcessor('替换为查询分析名称');

//执行查询并返回信息
$ret = $searchClient->execute($params->build());
//打印返回信息的内容
print_r(json_decode($ret->result));
//打印调试信息
echo $ret->traceInfo->tracer;