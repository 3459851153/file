<?php
    $log_post = $_POST;
    // print_r($_GET);
    header("content-type:application/json;charset=utf-8");
    $file_log = file_get_contents('./log_json.json');
    $json_arr = json_decode($file_log);
    if(!in_array($log_post["user"],$json_arr)){
        array_push($json_arr,$log_post["user"]);
        file_put_contents('./log_json.json',json_encode($json_arr));
        echo "can";
    }
    else{
        echo "notcan";
    }

?>