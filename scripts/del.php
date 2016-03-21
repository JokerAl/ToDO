<?php
$myFile = "tasks.json";
$task_id = $_POST["id"];
$tasks = json_decode(file_get_contents($myFile), TRUE);
$current_item = 0;
foreach($tasks as $i => $item){
    if($item['id'] == $task_id){
        $current_item = $item['id'];
        unset($tasks[$i]);
        break;
    }
}
var_dump($tasks);
$tasksJSON = json_encode(array_values($tasks));
var_dump($tasksJSON);
file_put_contents($myFile, $tasksJSON, LOCK_EX);
var_dump($myFile);