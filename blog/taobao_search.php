<?php
header("content-type;application/json;charset=utf8");
$taobao_content = file_get_contents('./taobao_search.json');
    $main = $_POST["search"];
    print_r($taobao_content);
?>