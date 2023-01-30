<?php
require "login.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otazky</title>
</head>
<body>
    <?php
    if (!($con = mysqli_connect($host,$user,$password,$database))){
        die("Nelze se připojit k databázi. </body> </html>");
    }
    if (isset($_POST["otazka"])){mysqli_query($con, "SET NAMES 'UTF8'");
    if (mysqli_query($con,"INSERT INTO otazky(otazka) VALUES ('".addslashes($_POST["otazka"]) . "')"))
    {
        echo "Úspěšně vloženo.";
    }}
    ?>
    <?php
    if (!($con = mysqli_connect($host,$user,$password,$database))){
    die("Nelze se připojit k databázi. </body> </html>");
    }
    mysqli_query($con, "SET NAMES 'UTF8'");
    if (!($vysledek = mysqli_query($con, "SELECT * FROM otazky"))){
    die ("Dotaz nelze provést.</body> </html>");
    }

    ?>
    <h1>Anketní otázky:</h1>
    <?php

    while ($radek = mysqli_fetch_array($vysledek)){
    ?>
    <p><?php echo $radek["otazka"]."<a href='detail_otazky.php?id=".$radek["id_otazky"]."'>- Detail</a>";?></p>
    <?php
    }
    mysqli_free_result($vysledek);
    mysqli_close($con)
    ?>
   <form action="form_otazky.php" method="POST">
       <textarea name="otazka" cols="30" rows="10" placeholder="Zadej novou otázku"></textarea>
       <input type="submit" value="odešli">
   </form>   
</body>
</html>