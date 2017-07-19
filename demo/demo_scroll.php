<?php
header("Content-Type:text/html;charset=utf-8");
//引入头文件
require_once("Config.inc.php");
use OpenSearch\Client\SearchClient;
use OpenSearch\Util\SearchParamsBuilder;

$searchClient = new SearchClient($client);
//创建参数对象，并指定对应参数
$params = new SearchParamsBuilder();
//设置每次scroll查询召回文档数，无需设置start参数
$params->setHits(1);
//设置应用名称
$params->setAppName('替换为应用名');
//设置查询query
$params->setQuery("name:'搜索'");
//设置返回格式
$params->setFormat("fulljson");
//添加排序，scroll只支持单字段排序，且字段类型必须是int
$params->addSort('id', SearchParamsBuilder::SORT_INCREASE);
//设置文档过滤条件
$params->setFilter('id>0');

//设置需返回哪些字段
$params->setFetchFields(array('id','name','phone','int_arr','literal_arr','float_arr','cate_id'));

//设置下次scroll发送请求超时时间，用于scroll方法查询，此处为第一次访问，用于获取scrollId
 $params->setScrollExpire('3m');
//执行查询并返回信息
$ret = $searchClient->execute($params->build())->result;

for($i=0;$i<json_decode($ret)->result->viewtotal;$i++){
	//通过上面第一次查询返回的scrollId，作为查询参数获取数据
	$params->setScrollId(json_decode($ret)->result->scroll_id);
	//再次执行查询并返回信息
	$ret = $searchClient->execute($params->build())->result;
	//打印返回信息的内容
	print_r($ret);
}