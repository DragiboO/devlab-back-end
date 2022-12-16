let onepage = document.querySelector('.onepage')


fetch(url_onepage).then((response) => response.json()).then(function(data) {
    console.log(data)

    onepage.innerHTML += `
            <div class="">
                <div class="">
                <img src="${"https://image.tmdb.org/t/p/original" + data.backdrop_path}" alt="affiche_du_film" class="h-[40vh]">
                </div>
                <div>
                    <h2 class="text-center">${data.title}</h2>
                </div>
            </div>
            `
})