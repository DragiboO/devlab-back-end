find()

function find() {

    let str = document.querySelector("#search");
    let propositions = document.querySelector(".result");

    if (str.value !== ""){
        axios.get('https://api.themoviedb.org/3/search/movie?api_key=f213e718db2b8476f73cd84bb74f1963&language=fr-FR&query='+str.value)

            .then(function (response) {

                console.log(response.data.results);
                let movie = response.data.results

                propositions.innerHTML = "";

                for (let i = 0; i <= 11; i++) {
                    let result = document.createElement("div");
                    result.classList += "relative"
                    result.innerHTML += `<a href="../page/onepage-movie.php?id=${movie[i].id}"><img src="${"https://image.tmdb.org/t/p/original" + movie[i].poster_path}" alt="affiche_du_film" class="rounded-3xl w-full"></a>`
                    result.innerHTML += `<p class="p-2 text-base absolute left-0 bottom-0 bg-orange-500 w-full rounded-b-3xl">${movie[i].title}</p>`
                    propositions.appendChild(result);
                }
            })

            .catch(function (error) {
                console.log(error);
            })

            .then();
    }else{
        propositions.innerHTML = "";
    }
}