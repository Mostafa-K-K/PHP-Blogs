<?php

require_once 'Dbconfig.php';

$id = $_GET['id'];
$idBlog = intval($id);

$stmt = $DB_con->prepare("SELECT * FROM Blogs WHERE blogID=:idBlog");
$stmt->bindparam(":idBlog", $idBlog);
$stmt->execute();
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['btn-save'])) {

    $title = $_POST['title'];
    $overview = $_POST['overview'];
    $content = $_POST['editor'];

    if (isset($_FILES["file"]) && !empty($_FILES["file"]["name"])) {

        $fileName = $_FILES["file"]["name"];
        $fileSize = $_FILES["file"]["size"] / 1024;
        $fileFormat = $_FILES["file"]["type"];
        $filePath = "upload/";

        $maxSize = 5 * 1024;

        if ($fileSize > $maxSize) {
            echo "file > 5 MB";
            return;
        } else if (file_exists(realpath('./upload') . '/' . $fileName)) {
            echo "file alredy exicte";
            return;
        }

        unlink('./upload/' . $blog['name']);
        move_uploaded_file($_FILES["file"]["tmp_name"], realpath('./upload') . '/' . $fileName);

    } else {
        $fileName = $blog['name'];
        $fileSize = $blog['size'];
        $fileFormat = $blog['format'];
        $filePath = $blog['path'];
    }

    try {
        $stmt = $DB_con->prepare("UPDATE Blogs SET title = :title, overview = :overview,
                                                content = :content, name = :fileName,
                                                size = :fileSize, format = :fileFormat
                                                WHERE blogID = :blogID");

        // $stmt->execute(['title' => $title, 'overview' => $overview, 'content' => $content,
        //     'fileName' => $fileName, 'fileSize' => $fileSize,
        //     'fileFormat' => $fileFormat, 'blogID' => $idBlog
        // ]);

        $stmt->bindparam(":title", $title);
        $stmt->bindparam(":overview", $overview);
        $stmt->bindparam(":content", $content);
        $stmt->bindparam(":fileName", $fileName);
        $stmt->bindparam(":fileSize", $fileSize);
        $stmt->bindparam(":fileFormat", $fileFormat);
        $stmt->bindparam(":blogID", $idBlog);
        $stmt->execute();

        $user->redirect('myBlogs.php');
        return $stmt;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
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

</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">

        <div class="container containerrad">
            <div class="allin">
                <h1 class="titleBlog">Edit BLOG</h1>

                <input type="text" value="<?php echo $blog['title'] ?>"  placeholder="Enter Title" name="title" id="title" required />

                <textarea name="overview" id="overview" placeholder="Overview"><?php echo $blog['overview'] ?></textarea>

                <div class="divofTextarea">
                    <textarea name="editor" id="editor"><?php echo $blog['content'] ?></textarea>
                </div>

                <div class="divofFile">
                    <input type="file" name="file" id="inputfilestyle" class="inputfilestyleNew"/>
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
