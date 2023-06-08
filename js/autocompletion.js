//          POUR L'INDEX          //         

const searchIndex = document.getElementById('search-bar2');
const resultIndex = document.getElementById('result2');

if (searchIndex) {
  searchIndex.addEventListener("keyup", () => {
    resultIndex.innerHTML = '';
        if (searchIndex.value != '') {
            fetch('php/autocompletion.php/?search=' + searchIndex.value)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    data.forEach(element => {
                        let e = document.createElement('p');
                        e.innerHTML = '<a href= "php/detail.php?article_id=' + element.idArt + '">' + element.titreArt;
                        resultIndex.appendChild(e);
                    });
                })
        }
    })
}

const linkIndex = window.location.href;
const idIndex = linkIndex.split('='); //sa split en deux une chaine de caractere au niveau du "="
fetch('autocompletion.php/?id=' + idIndex[1])
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        data.forEach(element => {
            let e = document.createElement('p');
            e.innerHTML = 'Nom: ' + element.titreArt + '</br>';
            resultIndex.appendChild(e);
        });
    })


//          POUR LES AUTRE PAGES          //       

const search = document.getElementById('search-bar');
const result = document.getElementById('result');
if (search) {
    search.addEventListener("keyup", () => {
        result.innerHTML = '';
        if (search.value != '') {
            fetch('autocompletion.php/?search=' + search.value)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    data.forEach(element => {
                        let e = document.createElement('p');
                        e.innerHTML = '<a href= "detail.php?article_id=' + element.idArt + '">' + element.titreArt;
                        result.appendChild(e);
                    });
                })
        }
    })
}

const link = window.location.href;
const id = link.split('='); //sa split en deux une chaine de caractere au niveau du "="
fetch('autocompletion.php/?id=' + id[1])
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        data.forEach(element => {
            let e = document.createElement('p');
            e.innerHTML = 'Nom: ' + element.titreArt + '</br>';
            result.appendChild(e);
        });
    })