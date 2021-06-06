<?php
require_once 'Dbconfig.php';

$id = $_GET['id'];
$idBlog = intval($id);

$stmt = $DB_con->prepare("SELECT * FROM Blogs WHERE blogID=:idBlog");
$stmt->bindparam(":idBlog", $idBlog);
$stmt->execute();
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

unlink('./upload/' . $blog['name']);

$stmt = $DB_con->prepare("DELETE FROM Blogs WHERE blogID=:idBlog");
$stmt->bindparam(":idBlog", $idBlog);
$stmt->execute();

if ($stmt) {
    header("location:myBlogs.php");
    exit;
}

?>