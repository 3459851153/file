<?php
    // $flie_enc = json_encode("123afasdadasdadad45");
    // $flie = file_put_contents("./json.json",$flie_enc,FILE_APPEND);
    // print_r($flie);
    $file = fopen("./text.text","a");
    fwrite($file,"123456");
    print_r(readfile("./text.text"));
?>