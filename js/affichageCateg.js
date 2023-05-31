let allItems = document.getElementById("allItems");
let categoryChild = document.querySelectorAll("input[type='radio']");
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
            console.log(element);
          let li = document.createElement("li");
          let imgArt = document.createElement("img");

          imgArt.className = "resultsImg";

          imgArt.src = element.imgArt;

          li.append(imgArt, element.titreArt, element.prix);
          allItems.append(li);
        });
      });

// * générer les enfants dans le parent correspondant
for (let i = 0; i < categoryChild.length; i++) {
  categoryChild[i].addEventListener("click", () => {
    allItems.innerHTML = "";
    fetch(`traitementCateg.php?subCategory=` + categoryChild[i].id)
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        data.forEach((element) => {
            console.log(element);
          let li = document.createElement("li");
          let imgArt = document.createElement("img");

          imgArt.className = "resultsImg";

          imgArt.src = element.imgArt;

          li.append(imgArt, element.titreArt, element.prix);
          allItems.append(li);
        });
      });
  });
}