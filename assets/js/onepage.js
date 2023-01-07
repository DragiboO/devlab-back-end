let onepage = document.querySelector('.onepage')


fetch(url_onepage).then((response) => response.json()).then(function(data) {
    console.log(data)

    onepage.innerHTML += `
            <div>
                <div>
                    <img src="${"https://image.tmdb.org/t/p/original" + data.backdrop_path}" alt="affiche_du_film" class="h-[30vh] xl:h-[70vh] w-full object-cover blur-sm relative">
                    <div class="background-onepage-moovie absolute h-[34vh] xl:h-[72vh] w-full top-[0%] xl:top-[10%] left-0"></div>
                    <img src="${"https://image.tmdb.org/t/p/original" + data.poster_path}" alt="affiche_du_film" class="h-[33vh] bottom-[58.5%] left-[25%] xl:h-[60vh] absolute bottom-[0%] left-[0%] xl:bottom-[10%] xl:left-[15%]">
                    <h2 class="static text-center xl:absolute xl:top-[74%] xl:left-[37%] text-base xl:text-3xl">${data.title}</h2>
                </div>
                <div class="grid-cols-1 pl-16 text-xs mt-2 xl:text-xl xl:mt-10 grid xl:grid-cols-3 xl:pl-24">
                    <div class="mb-4 xl:mt-14 xl:ml-36 text-sm xl:xl:text-xl">
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
                <div class="text-xs mt-2 xl:text-xl xl:mt-10 pr-12 pl-8 xl:px-36 grid grid-cols-2 ml-[-18.5em] mb-10">
                    <div></div>
                    <div>
                        <h2>Résumé :</h2>
                        <h2 class="text-justify mt-4">${data.overview}</h2>
                    </div>
                </div>
            </div>
            `
})