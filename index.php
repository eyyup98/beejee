<?php
ob_start();
session_start();
include_once "config/Database.php";
include_once "src/Tasks.php";
include_once "src/admin/AdminTasks.php";
if (isset($_POST['user'], $_POST['password']) && $_POST['user'] === 'admin' && $_POST['password'] === '123') {
    $_SESSION['user_role'] = 'admin';
}
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
    <title>Tasks</title>
</head>
<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="container">
            <div class="header_block">
                <a href="index.php"><img class="logo" src="src/view/images/1.png" alt="logo"></a>
                <div class="col-md-3 text-end">
<?php
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
    echo "<a type='button' class='btn btn-outline-primary' href='logout.php'>ВЫЙТИ</a>";
} else {
    echo "<a type='button' class='btn btn-primary' href='src/view/login.html'>ВОЙТИ</a>";
}
?>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
<?php
$tasks = new Tasks();
$numberList = $tasks->getNumberList();
$to = 3;
isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
isset($_GET['sort']) ? $sort = $_GET['sort'] : $sort = 'user';
$sortList = $tasks->getSortList();
?>
        <div style="display: flex; justify-content: space-between;">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                    Сортировка
                </button>
                <ul class="dropdown-menu dropdown-menu-begin">
<?php
foreach ($sortList as $key => $value) {
    if ($sort == $key) {
        echo "<li><a class='dropdown-item active' href='index.php?sort=$key&page=$page' aria-current='true'>$value</a></li>";
    } else {
        echo "<li><a class='dropdown-item' href='index.php?sort=$key&page=$page'>$value</a></li>";
    }
}
?>
                </ul>
            </div>
            <a href="create.php"><img src="src/view/images/3.png" alt="" style="margin: -10px 0 0; max-width: 40px;"></a>
        </div>
        <br>
<?php
$lists = $tasks->getList($page, $to, $sort);
foreach ($lists as $list) {
    if (isset($list['id'], $list['user'], $list['email'], $list['text'], $list['status'])) {
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            echo "<div class='edit_block'><a href='edit.php?taskId={$list['id']}'><img class='edit_img' src='src/view/images/2.png' alt='edit'></a></div>";
        }
        echo "<div class='content'><div class='first_content'>";
        echo "<h1 class='display-4'>{$list['user']}</h1>";
        if ($list['status'] == 0) {
            echo "<img class='img_status' src='src/view/images/no.png' alt='no'>";
        } else {
            echo "<img class='img_status' src='src/view/images/yes.png' alt='yes'>";
        }
        echo "</div>";
        echo "<h1 class='email_text'>{$list['email']}</h1>";
        echo "<div class='text'>{$list['text']}</div>";
        echo "</div>";
    }
}
?>
        <nav aria-label="...">
            <ul class="pagination pagination-lg justify-content-end">
<?php
for ($i = 1; $i <= ceil($numberList/$to); $i++) {
    if($page != $i){
        echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}&sort=$sort'>$i</a></li>";
    } else {
        echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
    }
}
?>
            </ul>
        </nav>
    </div>
<?php include "src/view/footer.html"?>
    <script type="javascript">
        var dropdownElementList = Array.prototype.slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        })
    </script>
</body>
</html>
