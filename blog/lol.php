<?php
    include './data_lol_detail.php';
    $arr = array();
    foreach($heroArr as $name=>$value){
        array_push($arr,$name);
    }
    one($heroArr,$arr);
    function one($heroArr,$arr){
        static $index = 0;
        echo $index;
        if($index>=count($heroArr)-1){
            return;
        };
        echo "<tr>";
        for($i=0;$i<4;$i++){
            $index++;
            echo "<td>
                    <img src={$heroArr[$arr[$index]]['champion_icon']}>
                    <h1>{$heroArr[$arr[$index]]['champion_name']}</h1>
                    <span>{$heroArr[$arr[$index]]['champion_title']}</span>
                    <button type='button' class='btn btn-primary'>详情</button>
                </td>";
        }
        echo "</tr>";
        one($heroArr,$arr);
    };
?>