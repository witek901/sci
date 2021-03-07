<?php
$id=$_GET["id"];
echo "<article>";
$con = mysqli_connect("localhost", "root", "", "graphics");
$sql = "SELECT * FROM articlebody ab INNER JOIN article a ON a.id=ab.id_article WHERE a.id='$id'";
$done = mysqli_query($con, $sql);
if (mysqli_num_rows($done) > 0){
    session_start();
    if (isset($_SESSION['message'])) {
        echo '<script type="text/javascript" class=\"added\">alert("' . $_SESSION['message'] . '");</script>';
        unset($_SESSION['message']);
    }
    while ($row = mysqli_fetch_assoc($done)){
        $id=$row["id"];
        echo "<h2>".$row["header"]."</h2><br>";
        echo "<br>";
        echo "<p><b>Rok stworzenia: </b>".$row["rok"]."</p><br>";
        echo "<p><b>Typ grafiki: </b>".$row["typ"]."</p><br>";
        echo "<p><b>Przykładowy rozmiar: </b>".$row["size"]."</p><br>";
        echo "<p><b>Rodzaj kompresji: </b>".$row["rodzaj"]."</p><br>";
        echo "<p><b>Wspieranie transparentnosci: </b>".$row["transparent"]."</p><br>";
        echo "<p><b>Wspieranie animacji: </b>".$row["animacje"]."</p><br>";
        echo "<p><b>Zastosowanie: </b>".$row["zastosowanie"]."</p><br>";
        echo "<p>".$row["body"]."</p><br>";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'DELETE' || ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_METHOD'] == 'DELETE')) {
    $delartbody = "DELETE FROM articlebody WHERE id_article=$id";
    $done = mysqli_query($con, $delartbody);
    if ($done !== false) {
        session_start();
        $delart = "DELETE FROM article WHERE id=$id";
        $done = mysqli_query($con, $delart);
        $_SESSION['message'] = "Usunieto artykul.";
        header("Location: index.php");
    }


}
    mysqli_close($con);

echo "<a href='edit.php?id=$id'><button class='edit' style='margin-left: 0.5%; float: left; padding: 0.5%'>Edytuj</button></a> ";

echo "<form method=\"POST\" onsubmit=\"return confirm('Jestes pewny?');\">
            <input type=\"hidden\" name=\"_METHOD\" value=\"DELETE\">
            <input type=\"hidden\" name=\"id\" value=\"<?php echo $id; ?\">
        <button type=\"submit\" style='margin-left: 0.5%; float: left; padding: 0.5%'>Usun</button>
        </form>";
echo "</article>";
echo "</section>";
?>