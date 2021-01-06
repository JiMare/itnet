<?php
 
 function nactiTridu($trida)
 {
     require("tridy/$trida.php");
 }

 spl_autoload_register("nactiTridu");

 Databaze::pripoj('localhost', 'root', '', 'diskuze');
 $diskuze = new Diskuze();

if($_POST){
    if(isset($_POST['prezdivka'])){
        $prezdivka = htmlspecialchars($_POST['prezdivka']);
    }
    if(isset($_POST['zprava'])){
        $zprava = htmlspecialchars($_POST['zprava']);
    }

    $diskuze->zapis($prezdivka, $zprava);
    header('Location: index.php');   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div style="width: 640px; margin: 0 auto;">
        <?php
			$diskuze->zobrazChat();
		?>

    <form method="post">
       Přezdívka<br>
        <input name="prezdivka" type="text"><br>
        Zpráva<br>
        <textarea name="zprava" cols="60" rows="2"></textarea><br>
        <div style="text-align: center">
        <input type="submit">
        </div>
    </form>
</div>   
</body>
</html>