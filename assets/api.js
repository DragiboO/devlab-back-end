moovie = document.querySelector(".afficher")
url = "https://api.themoviedb.org/3/movie/popular?api_key=f213e718db2b8476f73cd84bb74f1963&language=fr-FR"

fetch(url).then((response) => response.json()).then(function(data) {
    console.log(data.results)

    data.results.forEach(e => {

        moovie.innerHTML += `
            <a href="../page/onepage_moovie.php?id=${e.id}"><div class="bg-orange-500 rounded-3xl">
                <img src="${"https://image.tmdb.org/t/p/original" + e.poster_path}" alt="" class="rounded-t-2xl h-[522px] w-full">
                <h2 class="p-2 text-xl">${e.title}</h2>
            </div></a>
            `
    })

})