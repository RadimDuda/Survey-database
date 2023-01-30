<?php
require "login.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['id'])){
    $id = addslashes($_GET['id']);
    if (!($con = mysqli_connect($host,$user,$password,$database))) {
        die("Nelze se připojit k databázi. </body></html>");
    }   

    mysqli_query($con,"SET NAMES 'utf8'");
    if (!($vysledek = mysqli_query($con, "SELECT * FROM otazky WHERE id_otazky = '$id'"))) {
        die("Dotaz nelze provést. </body></html>");
    }
}
?>
<h1>Detail otázky:</h1>
   
<?php
    while ($radek = mysqli_fetch_array($vysledek)){
    ?>
    <p><?php echo "Otázka: ".$radek["otazka"];?></p>
    <?php
    }
        mysqli_free_result($vysledek);
        mysqli_close($con)
 ?>
<?php
if (!($con = mysqli_connect($host,$user,$password,$database)))
{
    die("Nelze se připojit k databázi.</body></html>");
}
mysqli_query($con,"SET NAMES 'utf8'");

if (isset($_POST['odpoved'])){
    mysqli_query($con,
            "INSERT INTO odpovedi(id_otazky, odpoved) VALUES('" .
            addslashes($_GET['id']). "', '" .
            addslashes($_POST["odpoved"]) . "')");
}
$id = $_GET['id'];
$vysledek=mysqli_query($con,"SELECT * from odpovedi WHERE id_otazky = '$id'");
if (mysqli_num_rows($vysledek)>0){
    while ($radek = mysqli_fetch_array($vysledek)){
        ?>
        <p><?php echo "Odpověď: ". $radek['odpoved']." <a href='detail.php?id=".$radek['id_otazky']."'";?>></a></p>

        <?php
        }
        }
    
mysqli_close($con); 
?>
 
<h2>Napiš odpověď</h2>
    <form action="detail_otazky.php?id=<?php if (isset($_GET['id'])){
    $id=$_GET['id']; echo addslashes($id);}?>"method="POST">
        <textarea name="odpoved" cols="30" rows="5"></textarea><br>
    <input type="hidden" value=<?php if (isset($_GET['id'])){
    $id=$_GET['id']; echo '"'.addslashes($id).'"';}?>>
    <input type="submit" value="Odeslat odpověď">
    </form>
</body>
</html>
