<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="scripts/main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <title>ToDo</title>
</head>
<body>
    <div class="container">
        <h1>ToDo</h1>
        <form id="add_task" class="add-task clear" method="post" action="" onsubmit="return false">
            <label for="task_name" class="label-name">Add your task:</label>
            <input type="text" id="task_name" class="name" name="task_name" value="" required>
            <button id="submit" type="submit" class="submit fa fa-plus-circle"></button>

        </form>

        <ul id="tasks" class="tasks">
            <li class="template">
                <input class="checkbox" type="checkbox">
                <p class="task-text"></p>
                <button class="del fa fa-minus-circle"></button>
            </li>
        </ul>
    </div>
</body>
</html>
