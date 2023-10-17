<?php
require_once("Config.inc.php");

use OpenSearch\Client\SuggestionClient;
use OpenSearch\Generated\Suggestion\ReSearch;
use OpenSearch\Generated\Suggestion\SuggestParams;

$suggestClient = new SuggestionClient($suggestName, $client);

$suggestParams = new SuggestParams();
$suggestParams->query = '阿里巴巴';
$suggestParams->hits = 15;
$suggestParams->userId = 'baz';
$suggestParams->reSearch = ReSearch::HOMONYM;
$suggestParams->customParams = array(
    'foo' => 'bar',
);

$ret = $suggestClient->execute($suggestParams)->result;
print_r(json_decode($ret, true));
