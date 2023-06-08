let allItems = document.getElementById("allItems");
let category = document.querySelectorAll(".category");
let categoryChild = document.querySelectorAll(".subCategory");
let categoryParent = document.querySelectorAll(".resultParent");

function allArticles() {
  fetch(`traitementArt.php`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.forEach((element) => {
        let divUnArt = document.createElement("div");
        let li = document.createElement("li");
        let imgArt = document.createElement("img");
        let linkart = document.createElement("a");
        linkart.setAttribute(
          "href",
          "./detail.php?article_id=" + element.idArt
        );
        imgArt.className = "resultsImg";

        imgArt.src = element.imgArt;
        linkart.append(imgArt);
        divUnArt.append(linkart, element.titreArt, element.prix);
        li.append(divUnArt);
        allItems.append(li);
      });
    });
}

function listenEvents() {
  for (let i = 0; i < categoryChild.length; i++) {
    categoryChild[i].addEventListener("click", () => {
      window.history.replaceState(
        null,
        null,
        "?" + categoryChild[i].name + "=" + categoryChild[i].id
      );

      affichageCateg();
    });
  }

  for (let i = 0; i < category.length; i++) {
    category[i].addEventListener("click", () => {
      window.history.replaceState(
        null,
        null,
        "?" + category[i].name + "=" + category[i].id
      );

      affichageCateg();
    });
  }
}

// * générer les SOUS CATEGORIES dans le parent correspondant

function thisSubCategorie(id) {
  allItems.innerHTML = "";
  fetch(`traitementCateg.php?subCategory=${id}`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.forEach((element) => {
        let divUnArt = document.createElement("div");
        let li = document.createElement("li");
        let imgArt = document.createElement("img");
        let linkart = document.createElement("a");
        linkart.setAttribute(
          "href",
          "./detail.php?article_id=" + element.idArt
        );
        imgArt.className = "resultsImg";

        imgArt.src = element.imgArt;
        linkart.append(imgArt);
        divUnArt.append(linkart, element.titreArt, element.prix);
        li.append(divUnArt);
        allItems.append(li);
      });
    });
}

// * générer les CATEGORIES

function thisCategorie(id) {
  allItems.innerHTML = "";
  fetch(`traitementCateg.php?category=${id}`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.forEach((element) => {
        let divUnArt = document.createElement("div");
        let li = document.createElement("li");
        let imgArt = document.createElement("img");
        let linkart = document.createElement("a");
        linkart.setAttribute(
          "href",
          "./detail.php?article_id=" + element.idArt
        );
        imgArt.className = "resultsImg";

        imgArt.src = element.imgArt;
        linkart.append(imgArt);
        divUnArt.append(linkart, element.titreArt, element.prix);
        li.append(divUnArt);
        allItems.append(li);
      });
    });
}

function affichageCateg() {
  const params = new URLSearchParams(window.location.search);
  const cat = params.get("category");
  const subcat = params.get("subCategory");
  if (params.size == 0) {
    allArticles();
  } else {
    if (subcat != null) {
      thisSubCategorie(subcat);
    } else if (cat != null) {
      thisCategorie(cat);
    }
  }
}
listenEvents();
affichageCateg();