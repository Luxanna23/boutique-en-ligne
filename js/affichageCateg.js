let allItems = document.getElementById("allItems");
let category = document.querySelectorAll(".category");
let categoryChild = document.querySelectorAll(".subCategory");
let categoryParent = document.querySelectorAll(".resultParent");


// * afficher ou cacher les child dans le parent correspondant au click du parent
category.forEach((element) => {
  element.addEventListener("click", () => {
    let childElement = document.querySelectorAll(
      "#categoryChildDiv" + element.getAttribute("id")
    );
    childElement[0].classList.toggle("categoryChildDivBlock");
  });
});

function allArticles() {
  fetch(`traitementArt.php`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.forEach((element) => {
        let divUnArt = document.createElement("div");
        let descri = document.createElement("div");
        let pTitre = document.createElement("p");
        let pPrix = document.createElement("p");
        let li = document.createElement("li");
        let imgArt = document.createElement("img");
        let linkart = document.createElement("a");
        linkart.setAttribute(
          "href",
          "./detail.php?article_id=" + element.idArt
        );
        imgArt.className = "resultsImg";
        pTitre.append(element.titreArt)
        pPrix.append(element.prix, "€")
        imgArt.src = element.imgArt;
        linkart.append(imgArt);
        descri.append(pTitre, pPrix);
        divUnArt.append(linkart, descri);
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
        let descri = document.createElement("div");
        let pTitre = document.createElement("p");
        let pPrix = document.createElement("p");
        let li = document.createElement("li");
        let imgArt = document.createElement("img");
        let linkart = document.createElement("a");
        linkart.setAttribute(
          "href",
          "./detail.php?article_id=" + element.idArt
        );
        imgArt.className = "resultsImg";
        pTitre.append(element.titreArt)
        pPrix.append(element.prix, "€")
        imgArt.src = element.imgArt;
        linkart.append(imgArt);
        descri.append(pTitre, pPrix);
        divUnArt.append(linkart, descri);
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
        let descri = document.createElement("div");
        let pTitre = document.createElement("p");
        let pPrix = document.createElement("p");
        let li = document.createElement("li");
        let imgArt = document.createElement("img");
        let linkart = document.createElement("a");
        linkart.setAttribute(
          "href",
          "./detail.php?article_id=" + element.idArt
        );
        imgArt.className = "resultsImg";
        pTitre.append(element.titreArt)
        pPrix.append(element.prix, "€")
        imgArt.src = element.imgArt;
        linkart.append(imgArt);
        descri.append(pTitre, pPrix);
        divUnArt.append(linkart, descri);
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
