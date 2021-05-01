<?php
 if(isset($_POST['belepes']))
    {
    try
        {
        $dbh = new PDO('mysql:host=localhost;dbname=beadsql', 'root', '',
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        if(isset($_POST['belepes'])) {
            $username = $_POST['login'];
             $password = sha1($_POST['jelszo']);
            $sql = "select * from felhasznalok where bejelentkezes = '$username' and jelszo =
                '$password'";
            $sth = $dbh->query($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)==0)
            echo "Hibás login név - jelszó pár!<br>";
                else{
                     $_SESSION['felhasznalo'] = $username;
                     foreach ($rows as $key => $value) {
                        $_SESSION['csaladi_nev'] = $value['csaladi_nev'];
                        $_SESSION['uto_nev'] = $value['uto_nev'];// code...
                     }
                     echo $_SESSION['felhasznalo'];
                     echo $_SESSION['csaladi_nev'];
                     echo $_SESSION['uto_nev'];
                    header('Location: .');
                   }

        }
        }catch (PDOException $e)
        {
        echo "Hiba: ".$e->getMessage();
        }
 }


?>
<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
 <title>PHP - MYSQL</title>
 </head>
 <body>
 <h1>Belépés</h1>
 <div>
 <div class="left">
 <form name="belepes" action="" method="post">
 <label for="login">Login:<input type = "text" name="login" id = "login"></label><br>
 <label for="jelszo">Jelszó: <input type = "password" name="jelszo" id = "jelszo"></label><br>
 <input type="submit" name="belepes" value="Belépés" class="btn btn-primary mb-2"><br>
 </form>
 </div>
 </div>
 </body>
</html>




    <h3><a href="?oldal=register"> Regisztrálja magát, ha még nem felhasználó!</a></h2>
