const search = document.getElementById('search-bar');
const result = document.getElementById('result');
if (search) {
    search.addEventListener("keyup", () => {
        result.innerHTML = '';
        if (search.value != '') {
            fetch(`./${getPage()}autocompletion.php/?search=` + search.value)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    data.forEach(element => {
                        let e = document.createElement('p');
                        e.innerHTML = `<a href= "./${getPage()}detail.php?article_id=` + element.idArt + `">` + element.titreArt;
                        result.appendChild(e);
                    });
                })
        }
    })
}

const link = window.location.href;
const id = link.split('='); //sa split en deux une chaine de caractere au niveau du "="
fetch(`./${getPage()}autocompletion.php/?id=` + id[1])
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