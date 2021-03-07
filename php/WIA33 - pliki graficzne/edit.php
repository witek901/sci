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
            $id=$_GET["id"];
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
                $id=$_GET["id"];
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
                $qHeader = mysqli_query($con, "SELECT header FROM article a WHERE a.id=$id");
                $wynikHeader = mysqli_fetch_assoc($qHeader);
                $sql1 = "UPDATE article SET header='$header' WHERE id=$id;";
                mysqli_query($con, $sql1);
                $sql = "UPDATE articlebody SET body='$body', rok='$rok', typ='$typ', size='$size', rodzaj='$rodzaj', transparent='$transparent', animacje='$animacje', zastosowanie='$zastosowanie' WHERE id_article=$id";
                mysqli_query($con, $sql);
                session_start();
                $_SESSION['message'] = "Zaktualizowano artykul.";
                mysqli_close($con);
                header("Location: show.php?id=$id");
            }
        }


        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["id"]) && !empty($_GET["id"])){
                $id=$_GET["id"];
                $con = mysqli_connect("localhost", "root", "", "graphics");
                $result=mysqli_query($con, "SELECT * FROM article WHERE id=$id");
                $articleData=mysqli_fetch_assoc($result);
                $header = $articleData["header"];
                $result=mysqli_query($con, "SELECT * FROM articlebody ab INNER JOIN article a ON a.id=ab.id_article WHERE a.id=$id");
                $articlebodyData=mysqli_fetch_assoc($result);
                $body = $articlebodyData["body"];
                $rok = $articlebodyData["rok"];
                $typ = $articlebodyData["typ"];
                $size = $articlebodyData["size"];
                $rodzaj = $articlebodyData["rodzaj"];
                $transparent = $articlebodyData["transparent"];
                $animacje = $articlebodyData["animacje"];
                $zastosowanie = $articlebodyData["zastosowanie"];
                mysqli_close($con);
            }
        }
        ?>

        <form action='edit.php?id=<?php echo $id;?>' method='POST'>
            <div class='left'>
                <p class='header'>
                    <label for='header'> Header: </label>
                    <input type='text' id='header' name='header' value='<?php echo $header;?>'> <span class='error'> <?php echo $headerErr;?></span>
                </p><br>
                <p class='body'>
                    <label for='body'> Body: </label>
                    <textarea style='resize:none' type='text' name='body' id='body' maxlength="2000"><?php echo $body;?></textarea><span class='error'> <?php echo $bodyErr;?></span>
                </p><br>
                <p class='rok'>
                    <label for='rok'> Rok stworzenia: </label>
                    <input type='text' id='rok' name='rok' value='<?php echo $rok;?>' maxlength = "4"> <span class='error'> <?php echo $rokErr;?></span>
                </p><br>
                <p class='typ'>
                    <label for='typ'> Typ grafiki: </label>
                    <select id="typ" name="typ" selected='<?php echo $typ;?>'>
                        <option value="rastrowa">Rastrowa</option>
                        <option value="wektorowa">Wektorowa</option>
                    </select><span class="error"> <?php echo $typErr;?></span>
                </p><br>
                <button type='submit' style='float: left; padding: 1%'>Submit</button>
            </div>
            <div class='right'>
                <p class='size'>
                    <label for='size'> Przykładowy rozmiar: </label>
                    <input type='text' id='size' name='size' value='<?php echo $size;?>' maxlength = "10"> <span class='error'> <?php echo $sizeErr;?></span>
                </p><br>
                <p class='rodzaj'>
                    <label for='rodzaj'> Rodzaj kompresji: </label>
                    <select id="rodzaj" name="rodzaj" selected='<?php echo $rodzaj;?>'>
                        <option value="stratna">Stratna</option>
                        <option value="bezstratna">Bezstratna</option>
                    </select> <span class="error"> <?php echo $rodzajErr;?></span>
                </p><br>
                <p class='transparent'>
                    <label for='transparent'> Transparentnosc: </label>
                    <select id="transparent" name="transparent" selected='<?php echo $transparent;?>'>
                        <option value="jest">Jest</option>
                        <option value="nie ma">Nie ma</option>
                    </select> <span class="error"> <?php echo $transparentErr;?></span>
               </p><br>
                <p class='animacje'>
                    <label for='animacje'> Animacje: </label>
                    <select id="animacje" name="animacje" selected='<?php echo $animacje;?>'>
                        <option value="jest">Jest</option>
                        <option value="nie ma">Nie ma</option>
                    </select> <span class="error"> <?php echo $animacjeErr;?></span>
               </p><br>
                <p class="zastosowanie">
                    <label for="zastosowanie"> Zastosowanie: </label>
                    <input type="text" id="zastosowanie" name="zastosowanie" value='<?php echo $zastosowanie;?>' maxlength="150"> <span class="error"> <?php echo $zastosowanieErr;?></span>
                </p><br>
            </div>
        </form>
    </article>
    </section>
<?php include 'footer.php';?>