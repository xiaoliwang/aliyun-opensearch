<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace OpenSearch\Client;

use OpenSearch\Generated\Suggestion\SuggestionServiceIf;
use OpenSearch\Generated\Suggestion\SuggestParams;
use OpenSearch\Util\SuggestUrlParamsBuilder;
use OpenSearch\Client\OpenSearchClient;

/**
 * 应用下拉提示操作类。
 *
 * 通过制定关键词、过滤条件搜索应用的下拉提示的结果。
 *
 */
class SuggestionClient implements SuggestionServiceIf
{
    const SUGGESTION_API_PATH = "/suggestions/%s/actions/search";

    private $suggestionName;
    private $openSearchClient;

    /**
     * 构造方法。
     *
     * @param string $suggestionName 下拉提示名称
     * @param \OpenSearch\Client\OpenSearchClient $openSearchClient 基础类，负责计算签名，和服务端进行交互和返回结果。
     * @return void
     */
    public function __construct(string $suggestionName, 
                                OpenSearchClient $openSearchClient)
    {
        $this->suggestionName = $suggestionName;
        $this->openSearchClient = $openSearchClient;
    }

    /**
     * 执行搜索操作。
     *
     * @param \OpenSearch\Generated\Suggestion\SuggestParams $suggestParams 指定的查询条件
     * @return \OpenSearch\Generated\Common\OpenSearchResult OpenSearchResult类
     */
    public function execute(SuggestParams $suggestParams)
    {
        $path = $this->getPath();
        $builder = new SuggestUrlParamsBuilder($suggestParams);
        return $this->openSearchClient->get($path, $builder->getHttpParams());
    }

    private function getPath()
    {
        return sprintf(self::SUGGESTION_API_PATH, $this->suggestionName);
    }

    /**
     * @deprecated
     */
    public function search()
    {
        throw new \BadMethodCallException();
    }
}