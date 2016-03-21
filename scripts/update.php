<?php
$myFile = "tasks.json";

$task_id = $_POST["id"];
$task_status = $_POST["status"];
$tasks = json_decode(file_get_contents($myFile), TRUE);
$current_item = 0;
foreach($tasks as &$item){
    if($item['id'] == $task_id){
        $item['status'] = $task_status;
        $current_item = $item;
        break;
    }
}

$tasksJSON = json_encode($tasks);
file_put_contents($myFile, $tasksJSON, LOCK_EX);
header('Content-Type: text/json');
echo json_encode($current_item);