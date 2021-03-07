<?php
echo "<section>";
echo "<nav>";
echo "<ul>";
echo "<li><a href='index.php'><b>Strona główna</b></a></li>";
echo "<li><a href='add.php'><b>Dodaj artykuł</b></a></li>";
echo "<li><br></li>";
$con = mysqli_connect("localhost", "root", "", "graphics");
$sql = "SELECT * FROM article";
$done = mysqli_query($con, $sql);
if (mysqli_num_rows($done) > 0){
    while ($row = mysqli_fetch_assoc($done)){
        echo "<li><a href='show.php?id=".$row["id"]."'>".$row["header"]."</a></li>";
    }
}
mysqli_close($con);
echo "</ul>";
echo "</nav>";
?>