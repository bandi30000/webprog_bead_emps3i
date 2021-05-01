<table class="table">
<thead>
    <tr>
        <th scope="col">Név</th>
        <th scope="col">E-mail</th>
        <th scope="col">Üzenet</th>
        <th scope="col">datum</th>
    </tr>
</thead>
<tbody>
<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=beadsql", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT nev, email, szoveg, datum from uzenetek order by datum desc");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

?>
    <?php foreach($stmt->fetchAll() as $k => $v) : ?>
        <tr>
            <td><?= $v['nev'] ?></td>
            <td><?= $v['email'] ?></td>
            <td><?= $v['szoveg'] ?></td>
            <td><?= $v['datum'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  $conn = null;
  ?>
  </table>
