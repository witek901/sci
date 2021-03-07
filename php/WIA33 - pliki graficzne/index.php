<?php include 'header.php';?>
<?php
session_start();
if (isset($_SESSION['message'])) {
    echo '<script type="text/javascript" class=\"added\">alert("' . $_SESSION['message'] . '");</script>';
    unset($_SESSION['message']);
}
?>
<?php include 'nav.php';?>
        <article>
            <h2>Witaj</h2><br>
            <p>Na tej stronie dowiesz sie wielu rzeczy na temat roznych plikow graficznych.</p>
        </article>
    </section>
<?php include 'footer.php';?>
