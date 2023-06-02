<?php
// phpinfo(); // pour chopper les infos version etc de mon php
require_once('classes/User.php');
ob_start(); // contre l'erreur d'header location 


?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAMYAS Boutique</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/020a26a846.js" crossorigin="anonymous"></script>
  <script src="./js/autocompletion.js" defer></script>
</head>

<body>
  <?php
  require_once('./includes/header.php'); ?>

  <main id="mainIndex">
    <div id="carouselAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="data:image/jpeg;base64,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" class="d-block w-100 img1" alt="">
          <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="data:image/jpeg;base64,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" class="d-block w-100 img2" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item ">
          <img src="https://www.histoiredor.com/dw/image/v2/BCQS_PRD/on/demandware.static/-/Sites-THOM_CATALOG/default/dw3615285b/images/B3OFJW00CW-model0.jpg?sw=750&sh=750" class="d-block w-100 img3" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
          </div>
        </div>
      </div>
    </div>
  </main>


  <?php
  require_once('includes/footer.php'); ?>
</body>
<script>
  fetch('./php/recherche.php?index=1').then(response => {
    return response.json();
  }).then(data => {
    let mainIndex = document.getElementById("mainIndex");
      let carousel2= document.createElement("div");
      carousel2.setAttribute("id", "carousel2");
      // carousel2.setAttribute("class", "scroll-up");
      mainIndex.append(carousel2);
    data.filter(function(resultats) {
      let article= document.createElement("div");
      article.setAttribute("id", "article");
      
      let img = document.createElement('img');
      let a = document.createElement("a");
      let nouveaute = document.createElement("p");
      nouveaute.setAttribute("id", "nouveaute");
     
      let img1 = document.getElementsByClassName("img1");
      // if(resultats.idCat==3){

      //         img1.setAttribute("src", resultats.imgCat);};
      for (let i = 0; i < 20; i++) {


        a.setAttribute("href", "php/detail.php?article_id=" + resultats.idArt);
        img.src = resultats.imgArt;
        carousel2.append(article)
        article.append(a);
        a.append(img);
        if (resultats.date > "2023-03-08") {
          nouveaute.textContent = "Nouveauté";
          a.append(img);
          article.append(a);
          article.append(nouveaute);
          carousel2.append(article);
        }



      }
    })
  }).catch(error => console.log(error))
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>