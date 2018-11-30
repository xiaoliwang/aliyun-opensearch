<?php
require_once("Config.inc.php");

use OpenSearch\Client\BehaviorCollectionClient;
use OpenSearch\Generated\BehaviorCollection\Command;

$searchAppName = "fx_data_collection_test_7";
$behaviorCollectionName = "51";
$jsonRecord = json_encode(array(
	[
		"cmd" => Command::$__names[Command::ADD],
		"fields" => [
			'event_id'    => 2001,
			'sdk_type'    => "opensearch_sdk",
			'sdk_version' => "v3.2.0",
			'page' => "doc_detail_page_name",
			'arg1' => "search_doc_list_page_name",
			'arg2' => "",
			'arg3' => 100,
			'args' => "object_id=record_pk_name,object_type=ops_search_doc,ops_request_misc=ops_request_misc={\"request_id\":\"153432217417441333635673\", \"scm\":\"a.b.c.d\"}",
		]
	]
));

$behaviorCollectionClient = new BehaviorCollectionClient($client);
$ret = $behaviorCollectionClient->push($jsonRecord, $searchAppName, $behaviorCollectionName);
print_r(json_decode($ret->result, true));
echo $ret->traceInfo->tracer;