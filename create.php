<?php
include_once "config/Database.php";
include_once "src/Tasks.php";

if(isset($_POST['user'], $_POST['email'], $_POST['text'])) {
    if ($_POST['user'] == '' || $_POST['email'] == '' || $_POST['text'] == ''){
        echo "<h1 style='font-size: 24px'>Необходимо заполнить все поля!</h1>";
        exit;
    }
    $task = new Tasks();
    $task->createTask($_POST['user'], $_POST['email'], $_POST['text']);
    header("Location: src/view/successfully.html");

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="src/view/images/favicon1.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/view/css/null.css">
    <link rel="stylesheet" href="src/view/css/style.css">
    <title>Create</title>
</head>
<body>
<form action="create.php" method="post">
    <div class="content container" style="margin: 100px auto 0; padding: 30px">
        <div class="form-group">
            <label for="" style="font-size: 20px; padding: 10px 0">Имя пользователя</label>
            <input class="form-control" id="exampleFormControlTextarea1" name="user">
            <label for="" style="font-size: 20px; padding: 10px 0">Эл. почта</label>
            <input class="form-control" id="exampleFormControlTextarea1" name="email">
        </div>
        <div class="form-group">
            <label for="" style="font-size: 20px; padding: 10px 0">Текст</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="text"></textarea>
        </div>
    </div>
    <div class="container" style="margin: 10px auto; padding: 30px; display: flex; justify-content:flex-end;">
        <a class="btn btn-danger" href="index.php" role="button">Отмена</a>
        <input class="btn btn-success" type="submit" value="Сохранить" style="margin: 0 0 0 10px">
    </div>
</form>

</body>
</html>
