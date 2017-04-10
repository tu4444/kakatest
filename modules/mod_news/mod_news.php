<?php

//print_r($params);
//改成以下兩行

require_once __DIR__.'/helper.php';
//專門處理顯示

//可用get.set設定功能
//modNewsHelper::show($params);

$items=modNewsHelper::getArticles($params);

//載入template
//1
//require JModuleHelper::getLayoutPath('mod_news','default');
//2
require JModuleHelper::getLayoutPath('mod_news',$params->get('layout','default'));


?>