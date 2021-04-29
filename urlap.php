<?php
	//szerver oldali ellenőrzés példa

	if(!isset($_POST['nev']) || strlen($_POST['nev']) < 5)
	{
		exit("Hibás név: ".$_POST['nev']);
	}

	$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
	if(!isset($_POST['email']) || !preg_match($re,$_POST['email']))
	{
		exit("Hibás email: ".$_POST['email']);
	}

	if(!isset($_POST['szoveg']) || empty($_POST['szoveg']))
	{
		exit("Hibás szöveg: ".$_POST['szoveg']);
	}

    $szoveg = new Uzenet();
    $szoveg->nev = $_POST['nev'];
    $szoveg->email = $_POST['email'];
    $szoveg->szoveg = $_POST['szoveg'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO szoveg (nev, email, szoveg) VALUES (:nev, :email, :szoveg)");
        $stmt->bindParam(':nev', $szoveg->nev);
        $stmt->bindParam(':email', $szoveg->email);
        $stmt->bindParam(':szoveg', $szoveg->szoveg);
        $stmt->execute();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
?>