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

namespace OpenSearch\Util;

use OpenSearch\Generated\Suggestion\Constant;
use OpenSearch\Generated\Suggestion\ReSearch;
use OpenSearch\Generated\Suggestion\SuggestParams;

/**
 * 下拉提示请求参数构建器
 */
class SuggestUrlParamsBuilder
{
    private $params = array();

    public function __construct(SuggestParams $suggestParams)
    {
        $this->init($suggestParams);
    }

    public function init(SuggestParams $suggestParams)
    {
        $this->initQuery($suggestParams);
        $this->initHits($suggestParams);
        $this->initUserId($suggestParams);
        $this->initReSearch($suggestParams);
        $this->initCustomParams($suggestParams);
    }

    public function initQuery($suggestParams)
    {
        if (isset($suggestParams->query)) {
            $this->params[Constant::get('PARAM_QUERY')] = $suggestParams->query;
        }
    }

    public function initHits($suggestParams)
    {
        if (isset($suggestParams->hits)) {
            $this->params[Constant::get('PARAM_HIT')] = $suggestParams->hits;
        }
    }

    public function initUserId($suggestParams)
    {
        if (isset($suggestParams->userId)) {
            $this->params[Constant::get('PARAM_USER_ID')] = $suggestParams->userId;
        }
    }

    public function initReSearch($suggestParams)
    {
        if (isset($suggestParams->reSearch)) {
            $enumString = ReSearch::$__names[$suggestParams->reSearch] ?: null;
            if ($enumString) {
                $this->params[Constant::get('PARAM_RE_SEARCH')] = strtolower($enumString);
            }
        }
    }

    public function initCustomParams($suggestParams)
    {
        if (isset($suggestParams->customParams)) {
            $this->params = array_merge($this->params, $suggestParams->customParams);
        }
    }

    public function getHttpParams()
    {
        return $this->params;
    }
}