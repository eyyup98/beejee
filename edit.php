<?php
ob_start();
session_start();
include_once "config/Database.php";
include_once "src/Tasks.php";
include_once "src/admin/AdminTasks.php";

// Пропуск толька для админа
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    $_SESSION['user_role'] = null;
    header("Location: index.php");
}

$adminTask = new AdminTasks();

// Сохранение изменений после нажатия кнопки "Сохранить"
if(isset($_POST['id'], $_POST['status'], $_POST['text'])) {
    if ($_POST['text'] == '') {
        echo "<h1>Текст не должен быть пустым!</h1>";
        exit;
    }
    $_POST['status'] == 'Выполнено' ? $status = 1 : $status = 0;
    $adminTask->updateStatus($_POST['id'], $status);
    $adminTask->updateText($_POST['id'], $_POST['text']);
    header("Location: src/view/successfully.html");
}

if (isset($_GET['taskId']) && $_GET['taskId'] != '') {
    $id = $_GET['taskId'];
} else {
    die('Ошибка запроса!');
}

$task = $adminTask->findTask($id);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/view/css/null.css">
    <link rel="stylesheet" href="src/view/css/style.css">
    <title>Edit Task</title>
</head>
<body>
<form action="edit.php" method="post">
    <div class="content container" style="margin: 100px auto 0; padding: 30px">
        <input type="text" name="id" value="<?php echo $id;?>" style="display: none;">
        <div class="form-group">
            <h1 class='display-4'>
<?php
if (isset($task['user'])) echo $task['user'];
?>
            </h1>
            <h1 class='email_text'>
<?php
if (isset($task['email'])) echo $task['email'];
?>
            </h1>
        </div>
        <div class="form-group">
            <label for="" style="font-size: 20px; padding: 10px 0">Статус</label>
            <select class="form-control" id="" name="status">
<?php
(isset($task['status']) && $task['status'] == 0) ? $status = ['Не выполнено', 'Выполнено'] : $status = ['Выполнено', 'Не выполнено'];
echo "<option>$status[0]</option>";
echo "<option class='active'>$status[1]</option>";
?>
            </select>
        </div>
        <div class="form-group">
            <label for="" style="font-size: 20px; padding: 10px 0">Текст</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="text">
<?php
if (isset($task['text'])) echo $task['text'];
?></textarea>
        </div>
    </div>
    <div class="container" style="margin: 10px auto; padding: 30px; display: flex; justify-content:flex-end;">
        <a class="btn btn-danger" href="index.php" role="button">Отмена</a>
        <input class="btn btn-success" type="submit" value="Сохранить" style="margin: 0 0 0 10px">
    </div>
</form>
</body>
</html>
