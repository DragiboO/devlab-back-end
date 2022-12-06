moovie = document.querySelector(".afficher")
url = "https://api.themoviedb.org/3/movie/top_rated?api_key=f213e718db2b8476f73cd84bb74f1963&language=en-US"

fetch(url).then((response) => response.json()).then(function(data) {
    console.log(data.results)

    data.results.forEach(e => {

        moovie.innerHTML += `
            <div class="bg-orange-500 rounded-3xl">
                <img src="${"https://image.tmdb.org/t/p/original" + e.poster_path}" alt="" class="rounded-t-2xl">
                <h2 class="p-2 text-xl">${e.title}</h2>
            </div>
            `
    })

})