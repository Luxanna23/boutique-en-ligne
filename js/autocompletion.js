// const search = document.getElementById("search-bar");
// const result = document.getElementById("result");
// if (search) {
//   search.addEventListener("keyup", () => {
//     result.innerHTML = "";
//     if (search.value != "") {
//       fetch("autocompletion.php/?search=" + search.value)
//         .then((response) => {
//           return response.json();
//         })
//         .then((data) => {
//           data.forEach((element) => {
//             let e = document.createElement("p");
//             e.innerHTML =
//               '<a href= "detail.php?id=' + element.id + '">' + element.nom;
//             result.appendChild(e);
//           });
//         });
//     }
//   });
// }

// const link = window.location.href;
// const id = link.split("="); //sa split en deux une chaine de caractere au niveau du "="
// fetch("autocompletion.php/?id=" + id[1])
//   .then((response) => {
//     return response.json();
//   })
//   .then((data) => {
//     data.forEach((element) => {
//       let e = document.createElement("p");
//       e.innerHTML =
//         "Nom: " + element.nom + "</br>Categorie: " + element.categorie;
//       result.appendChild(e);
//     });
//   });





let search = document.getElementById("recherche");
// console.log(searchValue);
search.addEventListener("keyup", () => {
  let main = document.querySelector("main");
  let divSearch = document.createElement("div");
  let filmsSearch = document.createElement("div");
  filmsSearch.setAttribute("class", "filmsSearch");
  let seriesSearch = document.createElement("div");
  seriesSearch.setAttribute("class", "seriesSearch");
  let acteursSearch = document.createElement("div");
  acteursSearch.setAttribute("class", "acteursSearch");
  main.innerHTML = "";
  filmsSearch.textContent = "";
  seriesSearch.textContent = "";
  acteursSearch.textContent = "";
  // console.log(search.value); si je declare une let searchValue= search.value, il ne reconnait pas searchValue, pk?
  fetch(
    "https://api.themoviedb.org/3/search/multi?api_key=7c8573e07bc29f162cd95a3850c8b3b1&language=en-US&page=1&include_adult=false&query=" +
      search.value,
    {
      method: "GET",
    }
  )
    .then((res) => res.json())
    .then((data) => {
      data.results.forEach((element) => {
        console.log(element);

        divSearch.setAttribute("class", "recherche");
        let a = document.createElement("a");
        let img = document.createElement("img");

        if (element.profile_path != null || element.poster_path != null) {
          // pour que les sans images ne s'affichent pas
          if (element.media_type == "movie") {
            img.src =
              "https://image.tmdb.org/t/p/original" + element.poster_path;
            a.setAttribute("href", "detail.php?movie_id=" + element.id);
            a.append(img);
            main.append(filmsSearch);
            filmsSearch.append(a);
          }
          if (element.media_type == "tv") {
            img.src =
              "https://image.tmdb.org/t/p/original" + element.poster_path;
            a.setAttribute("href", "detail.php?tv_id=" + element.id);
            a.append(img);
            main.append(seriesSearch);
            seriesSearch.append(a);
          }
          if (element.media_type == "person") {
            img.src =
              "https://image.tmdb.org/t/p/original" + element.profile_path;
            a.setAttribute("href", "detail.php?person_id=" + element.id);
            a.append(img);
            main.append(acteursSearch);
            acteursSearch.append(a);
          }
        }
      });
    });
});
const divSearch = document.querySelector(".search");
const btn = document.querySelector(".btn");
const input = document.querySelector(".input");

btn.addEventListener("click", () => {
  divSearch.classList.toggle("active"); //toggle metode add and remove in the same time class
  input.focus(); //i put focus in my input
});
