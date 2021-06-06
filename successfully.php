<?php
require_once 'Dbconfig.php';

if (!$user->is_loggedin()) {
    $user->redirect('Login.php');
}

if (isset($_POST['btn-done'])) {
    $user->redirect('myBlogs.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="./Blogs.css">

    <title>Done Blog</title>

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .header {
        overflow: hidden;
        );
        padding: 20px 10px;
    }

    .header a {
        float: left;
        color: black;
        text-align: center;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        line-height: 25px;
        border-radius: 4px;
        background-color: #FFFFFF;
        margin-right: 5px;
    }

    .header a.logo {
        font-size: 25px;
        font-weight: bold;
    }

    .header a:hover {
        color: black;
    }

    .header a.active {
        background-image: linear-gradient(to left, rgb(130, 0, 0), rgb(200, 0, 0));
        color: white;
    }

    .header-right {
        float: right;
        border-radius: 4px;
    }

    .colorDone{
    color: rgb(190, 0, 0);
    font-size:300%;
    font-weight: bold;
}

.containerrad{
    border-radius:20px
}
    </style>

</head>

<body>

    <div class="header">
        <a href="./Panel.php" class="logo">BLOGS</a>
        <div class="header-right">
            <a href="./allBlogs.php">All Blogs</a>
            <a href="./myBlogs.php">My Blogs</a>
            <a class="active" href="./addBlogs.php">New Blog</a>
        </div>
    </div>

    <form method="post">
        <div class="container containerrad">
            <div class="allin">

                <h1 class="colorDone">BLOG ADD SUCCESSFULLY</h1>

                <button type="submit" name="btn-done" class="savebtn">
                    Done
                </button>
            </div>
        </div>
    </form>

</body>

</html>
