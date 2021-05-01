<?php
    if(isset($_POST['felhasznalo']) && isset($_POST['jelszo']) && isset($_POST['vezeteknev']) && isset($_POST['utonev'])) {
        try {
            // Kapcsolódás
            $dbh = new PDO('mysql:host=localhost;dbname=beadsql', 'root', '',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            // Létezik már a felhasználói név?
            $sqlSelect = "select id from felhasznalok where bejelentkezes = :bejelentkezes";
            $sth = $dbh->prepare($sqlSelect);
            $sth->execute(array(':bejelentkezes' => $_POST['felhasznalo']));
            if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $uzenet = "A felhasználói név már foglalt!";
                $ujra = "true";
            }
            else {
                // Ha nem létezik, akkor regisztráljuk
                $sqlInsert = "insert into felhasznalok(id, csaladi_nev, uto_nev, bejelentkezes, jelszo)
                              values(0, :csaladinev, :utonev, :bejelentkezes, :jelszo)";
                $stmt = $dbh->prepare($sqlInsert);
                $stmt->execute(array(':csaladinev' => $_POST['vezeteknev'], ':utonev' => $_POST['utonev'],
                                     ':bejelentkezes' => $_POST['felhasznalo'], ':jelszo' => sha1($_POST['jelszo'])));
                if($count = $stmt->rowCount()) {
                    $newid = $dbh->lastInsertId();
                    $uzenet = "A regisztrációja sikeres.<br>Azonosítója: {$newid} ";
                    $ujra = false;
                }
                else {
                    $uzenet = "A regisztráció nem sikerült.";
                    $ujra = true;
                }
            }
        }
        catch (PDOException $e) {
            echo "Hiba: ".$e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Regisztráció</title>
        <meta charset="utf-8">
    </head>
    <body>
      <?php if(isset($uzenet)) { ?>
          <h1><?= $uzenet ?></h1>
          <?php if($ujra) { ?>
              Próbálja újra!
          <?php }else {?>
            <a href="?oldal=belep" class="btn btn-primary mb-2">Kattints ide!</a>
          <?php } ?>
      <?php } ?>
    <form action = "" method = "post">
      <fieldset>
        <legend>Regisztráció</legend>
        <br>
        <input type="text" name="vezeteknev" placeholder="vezetéknév" required><br><br>
        <input type="text" name="utonev" placeholder="utónév" required><br><br>
        <input type="text" name="felhasznalo" placeholder="felhasználói név" required><br><br>
        <input type="password" name="jelszo" placeholder="jelszó" required><br><br>
        <input type="submit" name="regisztracio" value="Regisztráció" class="btn btn-primary mb-2">
        <br>&nbsp;
      </fieldset>
    </form>
    </body>
</html>
