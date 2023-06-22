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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link rel="stylesheet" type="text/css" href="./css/header.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/020a26a846.js" crossorigin="anonymous"></script>
  <script src="./js/fonction.js" defer></script>
  <script src="./js/autocompletion.js" defer></script>
</head>

<body>
  <?php
  require_once('./includes/header2.php'); ?>
  <main id="mainIndex">
    <div id="carouselAutoplaying" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <!-- Div qui englobe le carousel qui est crée dynamiquement en JS -->
      </div>
    </div>
  </main>


  <?php
  require_once('includes/footer.php'); ?>
</body>
<script>
  // affiche le premier carousel
  fetch('./php/recherche.php?carousel=1').then(response => {
    return response.json();
  }).then(data => {
    console.log(data);
    let carouselInner=document.getElementsByClassName("carousel-inner");
    for(let i = 0; i<data.length; i++) {
      let carouselItem= document.createElement("div");
      if (i==0){
        carouselItem.setAttribute("class", "carousel-item active");
      }
      else {
        carouselItem.setAttribute("class", "carousel-item");
      }
      carouselInner[0].append(carouselItem);
      let img = document.createElement("img");
      img.setAttribute("id", "img"+i);
      img.setAttribute("class", "d-block w-50 ");
      img.setAttribute("alt", "img"+i)
      img.src=data[i].imgCarousel;
      carouselItem.append(img);

      let carouselCaption= document.createElement("div");
      carouselCaption.setAttribute("class", "carousel-caption d-none d-md-block")
      carouselItem.append(carouselCaption);

      let h5= document.createElement("h5");
      h5.setAttribute("id", "titre"+i);
      h5.textContent=data[i].titreCarousel;
      carouselCaption.append(h5);

      let p= document.createElement("p");
      p.setAttribute("id", "texte"+i);
      p.textContent=data[i].texteCarousel;
      carouselCaption.append(p);

    }
    }) .catch(error => console.log(error));


  fetch('./php/recherche.php?all=1').then(response => {
    return response.json();
  }).then(data => {
    let mainIndex = document.getElementById("mainIndex");
    let carousel2 = document.createElement("div");
    carousel2.setAttribute("id", "carousel2");
    // carousel2.setAttribute("class", "scroll-up");
    mainIndex.append(carousel2);
    data.filter(function(resultats) {
      let article = document.createElement("div");
      article.setAttribute("class", "article");
      let img = document.createElement('img');
      let a = document.createElement("a");
      
      let nouveaute = document.createElement("p");
      nouveaute.setAttribute("class", "nouveaute");

      let img1 = document.getElementsByClassName("img1");
      let date = new Date();
      let dateArt= new Date(resultats.date)
        let month= date.getMonth();
        date.setMonth(month-2);
        console.log(dateArt);
        console.log(resultats.date)
      for (let i = 0; i < 20; i++) {
        a.setAttribute("href", "php/detail.php?article_id=" + resultats.idArt);
        img.src = resultats.imgArt;
        carousel2.append(article)
        
        a.append(img);
        if (dateArt > date) {
          nouveaute.textContent = "Nouveauté";
          article.append(nouveaute);
          console.log(nouveaute);
        }
        article.append(a);
      }
    })
  }).catch(error => console.log(error))
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>