moovie = document.querySelector(".afficher")
url = "https://api.themoviedb.org/3/movie/popular?api_key=f213e718db2b8476f73cd84bb74f1963&language=fr-FR"

fetch(url).then((response) => response.json()).then(function(data) {

    data.results.forEach(e => {

        moovie.innerHTML += `
            <a href="../page/onepage-movie.php?id=${e.id}"><div class="rounded-3xl relative">
                <img src="${"https://image.tmdb.org/t/p/original" + e.backdrop_path}" alt="" class="rounded-3xl w-full">
                <h2 class="p-2 text-xs sm:text-base xl:text-base absolute left-0 bottom-0 xl:bottom-[-10%] bg-orange-500 w-full rounded-b-3xl">${e.title}</h2>
            </div></a>
            `
    })
})