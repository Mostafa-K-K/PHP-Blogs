<?php
require_once 'Dbconfig.php';

if (!$user->is_loggedin()) {
    $user->redirect('Login.php');
}

$userID = $_COOKIE['userID'];

if (isset($_POST['btn-save'])) {
    $title = $_POST['title'];
    $overview = $_POST['overview'];
    $content = $_POST['editor'];
    $datePublish = date("Y-m-d H:i:s");

    $fileName = $_FILES["file"]["name"];
    $fileSize = $_FILES["file"]["size"] / 1024; //in Kb
    $fileFormat = $_FILES["file"]["type"];
    $filePath = "upload/";

    $maxSize = 5 * 1024;

    if (isset($_FILES["file"])) {
        if ($fileSize > $maxSize) {
            echo "file > 5 MB";
            return;
        } else if (file_exists(realpath('./upload') . '/' . $fileName)) {
            echo "file alredy exicte";
            return;
        } else {

            try {
                $stmt = $DB_con->prepare("INSERT INTO Blogs(title, overview, content, datePublish, name, size, format, path, userID)
                                         VALUES (:title, :overview, :content, :datePublish, :fileName, :fileSize, :fileFormat, :filePath, :userID)");
                $stmt->bindparam(":title", $title);
                $stmt->bindparam(":overview", $overview);
                $stmt->bindparam(":content", $content);
                $stmt->bindparam(":datePublish", $datePublish);
                $stmt->bindparam(":fileName", $fileName);
                $stmt->bindparam(":fileSize", $fileSize);
                $stmt->bindparam(":fileFormat", $fileFormat);
                $stmt->bindparam(":filePath", $filePath);
                $stmt->bindparam(":userID", $userID);
                $stmt->execute();

                move_uploaded_file($_FILES["file"]["tmp_name"], realpath('./upload') . '/' . $fileName);

                $user->redirect('successfully.php');
                return $stmt;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

    } else {echo "Error: " . $_FILES["file"]["error"];}

}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>

    <link rel="stylesheet" href="./Blogs.css">

    <title>New Blog</title>

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

    .containerrad {
        border-radius: 20px;
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

    <form action="" method="post" enctype="multipart/form-data">

        <div class="container containerrad">
            <div class="allin">
                <h1 class="titleBlog">NEW BLOG</h1>

                <input type="text" placeholder="Enter Title" name="title" id="title" required />

                <textarea name="overview" id="overview" placeholder="Overview"></textarea>

                <div class="divofTextarea">
                    <textarea name="editor" id="editor"></textarea>
                </div>

                <div class="divofFile">
                    <input type="file" name="file" id="inputfilestyle" class="inputfilestyle" required/>
                </div>

                <button type="submit" name="btn-save" class="savebtn">
                    Save
                </button>
            </div>
        </div>
    </form>

    <script>
    CKEDITOR.replace('editor');
    </script>
    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</body>

</html>
