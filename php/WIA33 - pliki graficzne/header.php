<?php
echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Wojciech Pogorzelski 3c, SCI">
    <link rel="stylesheet" href="betterstyle.css">
<link href="https://fonts.googleapis.com/css?family=Archivo:500|Open+Sans:300,700" rel="stylesheet">
    <title>Graphics files</title>
</head>
<body>';

$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
if ($curPageName == "show.php"){
    $id=$_GET["id"];
    $con = mysqli_connect("localhost", "root", "", "graphics");
    $sql = "SELECT * FROM article a WHERE a.id=$id";
    $done = mysqli_query($con, $sql);
    if (mysqli_num_rows($done) > 0){
        while ($row = mysqli_fetch_assoc($done)){
            echo "<header><h1>".$row["header"]."</h1></header>";
        }
    }
    mysqli_close($con);
}
else if ($curPageName == "add.php") {
    echo "<header><h1>Dodawanie artykułu</h1></header>";
} else if ($curPageName == "edit.php") {
    echo "<header><h1>Edytowanie artykułu</h1></header>";
} else{
    echo "<header><h1>Graphics files</h1></header>";
}
?>