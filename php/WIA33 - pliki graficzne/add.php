<?php include 'header.php';?>
<?php include 'nav.php';?>
    <article>
<?php
$headerErr = $bodyErr = $rokErr = $typErr = $sizeErr = $rodzajErr = $transparentErr = $animacjeErr = $zastosowanieErr = "";
$header = $body = $rok = $typ = $size = $rodzaj = $transparent = $animacje = $zastosowanie = "";
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["header"])) {
            $headerErr = "Uzupelnij pole";
        } else if (empty($_POST["body"])) {
            $bodyErr = "Uzupelnij pole";
        } else if (empty($_POST["rok"])){
            $rokErr = "Uzupelnij pole";
        }  else if (empty($_POST["typ"])){
            $typErr = "Uzupelnij pole";
        }else if (empty($_POST["size"])){
            $sizeErr = "Uzupelnij pole";
        }else if (empty($_POST["rodzaj"])){
            $rodzajErr = "Uzupelnij pole";
        }else if (empty($_POST["transparent"])){
            $transparentErr = "Uzupelnij pole";
        }else if (empty($_POST["animacje"])){
            $animacjeErr = "Uzupelnij pole";
        }else if (empty($_POST["zastosowanie"])){
            $zastosowanieErr = "Uzupelnij pole";
        } else if (!ctype_digit($_POST["rok"])){
            $rokErr = "Tylko cyfry sa dozwolone!";
        }else{
            $header = test_input($_POST["header"]);
            $body = test_input($_POST["body"]);
            $rok = test_input($_POST["rok"]);
            $typ = test_input($_POST["typ"]);
            $size = test_input($_POST["size"]);
            $rodzaj = test_input($_POST["rodzaj"]);
            $transparent = test_input($_POST["transparent"]);
            $animacje = test_input($_POST["animacje"]);
            $zastosowanie = test_input($_POST["zastosowanie"]);
            $con = mysqli_connect("localhost", "root", "", "graphics");
            $sql = "SELECT id FROM article a WHERE a.header='$header'";
            $isExist = mysqli_query($con, $sql);
            if (mysqli_num_rows($isExist) >= 1){
                session_start();
                $_SESSION['message'] = "Artykul o takim tytule juz istnieje.";
                if (isset($_SESSION['message'])) {
                    echo '<script type="text/javascript" class=\"added\">alert("' . $_SESSION['message'] . '");</script>';
                    unset($_SESSION['message']);
                }
            }
            else{
                $con = mysqli_connect("localhost", "root", "", "graphics");
                $sql1 = "INSERT INTO article(header) VALUES ('$header');";
                mysqli_query($con, $sql1);
                $aid = mysqli_query($con, "SELECT id FROM article a WHERE a.header='$header'");
                $wynikArticle = mysqli_fetch_assoc($aid);
                $idArticle = $wynikArticle["id"];
                $sql = "INSERT INTO articlebody(id_article, body, rok, typ, size, rodzaj, transparent, animacje, zastosowanie) VALUES ('$idArticle', '$body', '$rok', '$typ', '$size', '$rodzaj', '$transparent', '$animacje', '$zastosowanie')";
                mysqli_query($con, $sql);
                $_SESSION['message'] = "Dodano artykul.";
                if (isset($_SESSION['message'])) {
                    echo '<script type="text/javascript" class=\"added\">alert("' . $_SESSION['message'] . '");</script>';
                    unset($_SESSION['message']);
                }
                mysqli_close($con);
            }
        }
    }
?>

        <form action="add.php" method="POST">
            <div class="left">
                <p class="header">
                    <label for="header"> Header: </label>
                    <input type="text" id="header" name="header"> <span class="error"> <?php echo $headerErr;?></span>
                </p><br>
                <p class="body">
                    <label for="body"> Body: </label>
                    <textarea style="resize:none" type="text" id="body" name="body" maxlength="2000"></textarea><span class="error"> <?php echo $bodyErr;?></span>
                </p><br>
                <p class="rok">
                    <label for="rok"> Rok: </label>
                    <input type="text" id="rok" name="rok" maxlength="4"> <span class="error"> <?php echo $rokErr;?></span>
                </p><br>
                <p class="typ">
                    <label for="typ"> Typ grafiki: </label>
                    <select id="typ" name="typ">
                        <option disabled selected value> -- Wybierz opcje -- </option>
                        <option value="rastrowa">Rastrowa</option>
                        <option value="wektorowa">Wektorowa</option>
                    </select><span class="error"> <?php echo $typErr;?></span>
                </p><br>
                <button type="submit" style='float: left; padding: 1%'>Submit</button>
            </div>
            <div class="right">
                <p class="size">
                    <label for="size"> Rozmiar pliku: </label>
                    <input type="text" id="size" name="size" maxlength="10"> <span class="error"> <?php echo $sizeErr;?></span>
                </p><br>
                <p class="rodzaj">
                    <label for="rodzaj"> Rodzaj kompresji: </label>
                    <select id="rodzaj" name="rodzaj">
                        <option disabled selected value> -- Wybierz opcje -- </option>
                        <option value="stratna">Stratna</option>
                        <option value="bezstratna">Bezstratna</option>
                    </select> <span class="error"> <?php echo $rodzajErr;?></span>
                </p><br>
                <p class="transparent">
                    <label for="transparent"> Transparentnosc: </label>
                    <select id="transparent" name="transparent">
                        <option disabled selected value> -- Wybierz opcje -- </option>
                        <option value="jest">Jest</option>
                        <option value="nie ma">Nie ma</option>
                    </select> <span class="error"> <?php echo $transparentErr;?></span>
                </p><br>
                <p class="animacje">
                    <label for="animacje"> Animacje: </label>
                    <select id="animacje" name="animacje">
                        <option disabled selected value> -- Wybierz opcje -- </option>
                        <option value="jest">Jest</option>
                        <option value="nie ma">Nie ma</option>
                    </select> <span class="error"> <?php echo $animacjeErr;?></span>
                </p><br>
                <p class="zastosowanie">
                    <label for="zastosowanie"> Zastosowanie: </label>
                    <input type="text" id="zastosowanie" name="zastosowanie" maxlength="150"> <span class="error"> <?php echo $zastosowanieErr;?></span>
                </p><br>
            </div>
        </form>
    </article>
</section>
<?php include 'footer.php';?>