<!DOCTYPE html>
<html>
  <head>
  <?php if (isset($_POST['submit'])){
            $file = $_FILES['file'];

            $filename = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $filename);
            echo $filename;
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','jpeg','png','gif');
            if(in_array($fileActualExt, $allowed)){
                    if($fileError == 0){
                        if($fileSize < 1000000){
                            $fileNameNew = uniqid('', true).".".$fileActualExt;
                            $fileDestination = $dir.$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            header("location:#");
                        }
                    }else{
                        echo "Hiba felöltéskor";
                    }
            }else{

                echo $fileActualExt ; echo $filename ;
                echo "Nem tölthetsz fel ilyen kiterjesztésű file-t.";
            }

        }
?>
    <title>Very Simple PHP gallery</title>

    <!-- (A) CSS & JS -->
    <link href="gallery.css" rel="stylesheet">
    <script>window.addEventListener("DOMContentLoaded", function(){
  // (A) GET ALL IMAGES
  var all = document.querySelectorAll(".gallery img");

  // (B) CLICK ON IMAGE TO TOGGLE FULLSCREEN
  if (all.length>0) { for (let img of all) {
    img.addEventListener("click", function(){
      // EXIT FULLSCREEN
      if (document.webkitFullscreenElement || document.fullscreenElement) {
        if (document.exitFullscreen) { document.exitFullscreen(); }
        else if (document.webkitExitFullscreen) { document.webkitExitFullscreen(); }
      }

      // ENGAGE FULLSCREEN
      else {
        if (this.requestFullscreen) { this.requestFullscreen(); }
        else if (this.webkitRequestFullscreen) { this.webkitRequestFullscreen(); }
      }
    });
  }}
});</script>



<style>/* (A) GALLERY CONTAINER */
/* (A1) ON BIG SCREENS */
.gallery {
  display: grid;
  grid-template-columns: repeat(3, auto); /* 3 IMAGES PER ROW */
  grid-gap: 10px;
  max-width: 1200px;
  margin: 0 auto; /* HORIZONTAL CENTER */
}
/* (A2) ON SMALL SCREENS */
@media screen and (max-width: 640px) {
  .gallery {
    grid-template-columns: repeat(2, auto); /* 2 IMAGES PER ROW */
  }
}

/* (B) THUMBNAILS */
.gallery img {
  width: 100%;
  height: 200px;
  cursor: pointer;
  /* FILL, CONTAIN, COVER, SCALE-DOWN : USE WHICHEVER YOU LIKE */
  object-fit: cover;
}
.gallery img:fullscreen { object-fit: contain; }

/* (X) DOES NOT MATTER */
body, html {
  padding: 0;
  margin: 0;
}</style>
  </head>
  <body>
    <div class="gallery"><?php
    // (B) GET LIST OF IMAGE FILES FROM GALLERY FOLDER
    $dir = ".". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;
    $images = glob($dir . "*.{jpg,jpeg,png,bmp,webp}", GLOB_BRACE);

    // (C) OUTPUT IMAGES
    foreach ($images as $i) {
      printf("<img src='images/%s'/>", basename($i));
    }
    ?></div>

<?php if (isset($_SESSION['felhasznalo'])) : ?>
    <div class="d-flex justify-content-center  mt-5">
        <form class="form-inline"action="" method="POST" enctype="multipart/form-data">
        <input class="form-control-file"type="file" name="file">
        <button class="btn btn-primary mb-2"type="submit" name="submit">FELTÖLTÉS</button>
        </form>
    </div>
<?php endif; ?>
  </body>
</html>
