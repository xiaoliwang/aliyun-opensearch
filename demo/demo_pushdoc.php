<?php
//引用头部文件
require_once("Config.inc.php");
use OpenSearch\Client\DocumentClient;
//设置数据需推送到对应应用表中
$tableName = '替换为应用表名';
//创建文档操作client
$documentClient = new DocumentClient($client);
//添加数据
$docs_to_upload = array();
for ($i = 0; $i < 1; $i++){
    $item = array();
    $item['cmd'] = 'ADD';
    $item["fields"] = array(
		"id" => $i + 1,
        "name" => "搜索".$i
		);
    $docs_to_upload[] = $item;
}
//将文档编码成json格式
$json = json_encode($docs_to_upload);
//提交推送文档
$ret = $documentClient->push($json, $appName, $tableName);
//打印调试信息
echo $ret->traceInfo->tracer;