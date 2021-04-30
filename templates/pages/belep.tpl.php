<<?php
    if(isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) {
        try {
            // Kapcsolódás
            $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            
            // Felhsználó keresése
            $sqlSelect = "select id, csaladi_nev, uto_nev from felhasznalok where bejelentkezes = :bejelentkezes and jelszo = sha1(:jelszo)";
            $sth = $dbh->prepare($sqlSelect);
            $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => $_POST['jelszo']));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo "Hiba: ".$e->getMessage();
        }      
    }
?>
<?php if(isset($_POST['felhasznalo']) && isset($_POST['jelszo'])) { 
                $errors = array();
                $true = true;
                if(empty($_POST["felhasznalo"])){
                    $true = false;
                    array_push($errors, "A felhasználónév üres");
                }
                if(empty($_POST["jelszo"])){
                    $true = false;
                    array_push($errors, "a jelszó mező üres");
                }
                if($true){
                    $username = $_POST['felhasznalo'];
                    $_SESSION['felhasznalo'] = $username;
                    echo $_SESSION['felhasznalo'];
                    header('Location: .');
                }
                
        
        
        
        } ?>

    <form action = "" method = "post">
      <fieldset>
        <legend>Bejlentkezés</legend>
        <br>
        <input type="text" name="felhasznalo" placeholder="felhasználó" required><br><br>
        <input type="password" name="jelszo" placeholder="jelszó" required><br><br>
        <input type="submit" name="belepes" value="Belépés">
        <br>&nbsp;
      </fieldset>
    </form>
    <?php 
    if (!empty($errors)){
        foreach ($errors as $key ){
            echo $key."<br/>";
        }


    }
    ?>
    
    <h3><a href="?oldal=register"> Regisztrálja magát, ha még nem felhasználó!</a></h2>
        


