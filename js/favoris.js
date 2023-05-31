const list_favoris = document.getElementById("list_favoris");
// FETCH POUR LA BASE DE DONNEE

fetch("../php/favoris.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    data.forEach((element) => {
      // FETCH POUR LES DETAILS DES FILM FAVORIS
      
        let a = document.createElement("a");
        let img = document.createElement("img");
        let titre = document.createElement("p");

        a.href = `detail.php?id=${favoris.id}`;
        //img.src = API_IMAGE_URL + favoris.poster_path;

        a.append(img, titre);
        titre.textContent = favoris.title;
        list_favoris.append(a);
          
        });
  });