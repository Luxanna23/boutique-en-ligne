let allItems = document.getElementById("allItems");
let category = document.querySelectorAll(".category");
let categoryChild = document.querySelectorAll(".subCategory");
let categoryParent = document.querySelectorAll(".resultParent");

// * afficher ou cacher les child dans le parent correspondant au click du parent
categoryParent.forEach((element) => {
  element.addEventListener("click", () => {
    let childElement = document.querySelectorAll(
      "#categoryChildDiv" + element.getAttribute("id")
    );
    childElement[0].classList.toggle("categoryChildDivBlock");
  });
});

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
      linkart.setAttribute("href","./detail.php?article_id=" + element.idArt);
      imgArt.className = "resultsImg";

      imgArt.src = element.imgArt;
      linkart.append(imgArt);
      divUnArt.append(linkart, element.titreArt, element.prix);
      li.append(divUnArt);
      allItems.append(li);
    });
  });

// * générer les SOUS CATEGORIES dans le parent correspondant
for (let i = 0; i < categoryChild.length; i++) {
  categoryChild[i].addEventListener("click", () => {
    allItems.innerHTML = "";
    fetch(`traitementCateg.php?subCategory=` + categoryChild[i].id)
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        data.forEach((element) => {
          let divUnArt = document.createElement("div");
      let li = document.createElement("li");
      let imgArt = document.createElement("img");
      let linkart = document.createElement("a");
      linkart.setAttribute("href","./detail.php?article_id=" + element.idArt);
      imgArt.className = "resultsImg";

      imgArt.src = element.imgArt;
      linkart.append(imgArt);
      divUnArt.append(linkart, element.titreArt, element.prix);
      li.append(divUnArt);
      allItems.append(li);
        });
      });
  });
}

// * générer les CATEGORIES
for (let i = 0; i < category.length; i++) {
  category[i].addEventListener("click", () => {
    allItems.innerHTML = "";
    fetch(`traitementCateg.php?category=` + category[i].id)
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        data.forEach((element) => {
          let divUnArt = document.createElement("div");
      let li = document.createElement("li");
      let imgArt = document.createElement("img");
      let linkart = document.createElement("a");
      linkart.setAttribute("href","./detail.php?article_id=" + element.idArt);
      imgArt.className = "resultsImg";

      imgArt.src = element.imgArt;
      linkart.append(imgArt);
      divUnArt.append(linkart, element.titreArt, element.prix);
      li.append(divUnArt);
      allItems.append(li);
        });
      });
  });
}
