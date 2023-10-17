# aliyun-opensearch

该项目主要是给阿里云开放搜索v3版本加一个composer.json，可以使用composer install安装

[官网链接](https://help.aliyun.com/zh/open-search/industry-algorithm-edition/downloads-2?spm=a2c4g.11186623.0.0.3a887188XmnILu)

版本号发布同步官方

## 如何更新的

1. 从官网下载最新的 SDK，解压
2. 删除当前项目的 demo 和 OpenSearch 目录
3. 复制新的 SDK 中的 demo 和 OpenSearch 目录到此项目
4. 检查更新的内容，打补丁（目前已知的补丁维护在下面文档中）
5. 提交代码（update to vX.X.X）
6. 发布新版本

## 补丁（与官方版本的差异）

[OpenSearchClient.php](OpenSearch%2FClient%2FOpenSearchClient.php#L301) 301 行增加了 curl 请求失败抛出异常
