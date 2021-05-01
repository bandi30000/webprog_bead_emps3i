<?php

session_start();
if (isset($keres) && file_exists("./logicals/{$keres['fajl']}.php")) {
    include("./logicals/{$keres['fajl']}.php");
}
?>
<!DOCTYPE html>
<html lang="hu" class="h-100">
<head>
<link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $ablakcim['cim'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column h-100">
    <header>
      <?php if (isset($_SESSION['felhasznalo'])) : ?>
      <div class="d-flex justify-content-end form-floating">
          <span class="badge text-light bg-dark">Bejelentkezett: <?= $_SESSION['csaladi_nev'] ?>&nbsp;<?= $_SESSION['uto_nev'] ?> (<?= $_SESSION['felhasznalo'] ?>)</span>
      </div>
      <?php endif; ?>
        <nav class="navbar navbar-expand-md navbar-light bg-first">
            <div class="container-fluid">
                <a href="/webprog_beadando-master/" class="navbar-brand">
                    <img src="./images/logo.gif " class="img-fluid" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <?php foreach ($oldalak as $url => $oldal) : ?>
                        <?php if (!isset($_SESSION['felhasznalo']) && $oldal['menun'][0]
                            || isset($_SESSION['felhasznalo']) && $oldal['menun'][1]) : ?>
                        <li class="nav-item">
                            <a class="nav-link<?= $oldal == $keres ? ' active' : '' ?>" href="<?= ($url == '/') ? '.' : ('?oldal=' . $url) ?>">
                                <?= $oldal == $keres ? '<u>' : '' ?><?= $oldal['szoveg'] ?><?= $oldal == $keres ? '</u>' : '' ?>
                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </nav>
        <?php if ($keres['fajl']=='cimlap') : ?><a href="#ide"><div class="masik-image"></div></a>
        <?php else: ?>
        <div class="hero-image"></div>
        <?php endif; ?>
    </header>

    <main class="flex-shrink-0" id="ide">
            <div class="p-5 mt-5 mb-4 container">
                <?php include("./templates/pages/{$keres['fajl']}.tpl.php"); ?>
            </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted"><?= $lablec['copyright'] ?> - <?= $lablec['ceg'] ?></span>
            <a href="https://www.macskamentok.hu/" >Link az eredeti oldalra</a>
        </div>

    </footer>

    <?php if (isset($keres) && file_exists("./scripts/{$keres['fajl']}.js")) : ?>
    <script src="<?= "./scripts/{$keres['fajl']}.js" ?>"></script>
    <?php endif; ?>
</body>
</html>
