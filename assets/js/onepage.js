let onepage = document.querySelector('.onepage')


fetch(url_onepage).then((response) => response.json()).then(function(data) {
    console.log(data)

    onepage.innerHTML += `
            <div>
                <div>
                    <img src="${"https://image.tmdb.org/t/p/original" + data.backdrop_path}" alt="affiche_du_film" class="h-[70vh] w-full object-cover blur-sm relative">
                    <div class="background-onepage-moovie absolute h-[71vh] w-full top-[90px] left-0"></div>
                    <img src="${"https://image.tmdb.org/t/p/original" + data.poster_path}" alt="affiche_du_film" class="h-[60vh] absolute bottom-[10%] left-[13%]">
                    <h2 class="absolute top-[74%] left-[39%] text-3xl">${data.title}</h2>
                </div>
                <div class="mt-10 grid grid-cols-3 pl-[10em]">
                    <div class="mt-[4.5rem] ml-24 text-xl">
                        <h2>Ajouter à une liste</h2>
                    </div>
                    <div class="flex gap-y-4 flex-col">
                        <h2>Titre original : ${data.original_title}</h2>
                        <h2>Score : ${data.vote_average}</h2>
                        <h2>Durée : ${data.runtime}min</h2>
                        <h2>Genres : ${data.genres.length}</h2>
                    </div>
                    <div class="flex gap-y-4 flex-col">
                        <h2>Pays d'origine : ${data.production_countries}</h2>
                        <h2>Date de sortie : ${data.release_date}</h2>
                        <h2>Revenue : ${data.revenue} $</h2>
                        <h2>Coût de production : ${data.budget} $</h2>
                    </div>
                </div>
                <div class="mt-10 px-36 grid grid-cols-2 ml-[-26em] mb-10">
                    <div></div>
                    <div>
                        <h2>Résumé :</h2>
                        <h2 class="text-justify mt-4">${data.overview}</h2>
                    </div>
                </div>
            </div>
            `
})