<?php
$myFile = "tasks.json";

$task_name = $_POST["task"];

$tasks = json_decode(file_get_contents($myFile), TRUE);
if(is_array($tasks)){
    $numbers = array_map(function($task) {
        return $task['id'];
    }, $tasks);
    if(empty($numbers)){
        $id = 1;
    } else {
        $id = max($numbers) + 1;
    }
}
$item = array("id" => $id, "task" => $task_name, "status" => "open");
if(is_array($tasks)) {
    array_unshift($tasks, $item);
}
else {
    $tasks = array($item);
}
$tasksJSON = json_encode($tasks);
file_put_contents($myFile, $tasksJSON, LOCK_EX);

header('Content-Type: text/json');
echo json_encode($item);
