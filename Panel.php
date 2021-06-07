<?php
require_once 'Dbconfig.php';

if (!$user->is_loggedin()) {
    $user->redirect('Login.php');
}
$userID = $_COOKIE['userID'];
$stmt = $DB_con->prepare("SELECT * FROM Users WHERE userID=:userID");
$stmt->execute(array(":userID" => $userID));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn-logout'])) {
    if ($user->logout()) {
        $user->redirect('Home.php');
    }
    ;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>welcome <?php print($userRow['email']);?></title>
    <link rel="stylesheet" href="./Blogs.css">
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
    </style>
</head>

</head>

<body>

    <div class="header">
        <a href="./Panel.php" class="logo active">BLOGS</a>
        <div class="header-right">
            <a href="./allBlogs.php">All Blogs</a>
            <a href="./myBlogs.php">My Blogs</a>
            <a href="./addBlogs.php">New Blog</a>
        </div>
    </div>

    <div class='panelHome'>

    <p>
        welcome : <?php print($userRow['username']);?>
    </p>
        <div>
            <form method='post'>
                <button type='submit' name="btn-logout">Logout</button>
            </form>
        </div>

    </div>

</body>

</html>