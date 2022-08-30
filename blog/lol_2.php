<?php
    include './data_lol_detail.php';
    $get=$_GET;
    echo $heroArr[$get["name"]]["champion_name"]."||".
         $heroArr[$get["name"]]["champion_title"]."||".
         $heroArr[$get["name"]]["champion_info"]."||".
         $heroArr[$get["name"]]["champion_tags"]."||".
         $heroArr[$get["name"]]["champion_icon"]."||<tr><td>
         <img src={$heroArr[$get["name_search"]]['champion_icon']}>
         <h1>{$heroArr[$get["name_search"]]['champion_name']}</h1>
         <span>{$heroArr[$get["name_search"]]['champion_title']}</span>
         <button type='button' class='btn btn-primary'>详情</button>
     </td></tr>||";
     if($get["pinyin"] != ""){
        echo "<tr>";
     foreach($heroArr as $name=>$value){
         if($value["champion_pinyin"][0] == strtolower($get["pinyin"])){
             echo "<td>
             <img src={$value['champion_icon']}>
             <h1>{$value['champion_name']}</h1>
             <span>{$value['champion_title']}</span>
             <button type='button' class='btn btn-primary'>详情</button>
         </td>";
         }
     }
     echo "</tr>";
 }
?>