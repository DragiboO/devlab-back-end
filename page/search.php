<?php require "header.php"; ?>

<form method="POST" class="ml-0 p-8 xl:ml-10 xl:p-10">
    <input type="text" name="search" onkeyup="find()" placeholder="Taper votre recherche..." class="text-white bg-black p-2 text-xs pr-10 sm:pr-25 lg:pr-35 xl:pr-60" id="search">
</form>

<div class="result grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-y-6 pb-6 sm:gap-x-8 sm:gap-y-8 lg:gap-x-10 lg:gap-y-10 lg:px-14 sm:mb-8 lg:mb-10 px-10  xl:gap-x-14 xl:p-40 text-center xl:gap-y-14 xl:pt-10 xl:pb-10">

</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    //const axios = require('axios');

    find()

    function find(){
        // Requêter un utilisateur avec un ID donné.

        let str = document.querySelector("#search");
        let propositions = document.querySelector(".result");

        if (str.value !== ""){
            axios.get(/* '/user?ID=2' */ 'https://api.themoviedb.org/3/search/movie?api_key=f213e718db2b8476f73cd84bb74f1963&query='+str.value)

                .then(function (response) {
                    // en cas de réussite de la requête
                    console.log(response.data.results);
                    let movie = response.data.results

                    propositions.innerHTML = "";

                    for (let i = 0; i <= 11; i++) {
                        let result = document.createElement("div");
                        result.classList += "relative"
                        let myLink = "single.php?id="+movie[i].id
                        result.innerHTML += `<a href="../page/onepage_moovie.php?id=${movie[i].id}"><img src="${"https://image.tmdb.org/t/p/original" + movie[i].poster_path}" alt="affiche_du_film" class="rounded-3xl w-full"></a>`
                        result.innerHTML += `<p class="p-2 text-base absolute left-0 bottom-0 bg-orange-500 w-full rounded-b-3xl">${movie[i].title}</p>`
                        propositions.appendChild(result);
                    }
                })

                .catch(function (error) {
                    // en cas d’échec de la requête
                    console.log(error);
                })

                .then(function () {
                    // dans tous les cas
                    console.log("Voila");
                });
        }else{
            propositions.innerHTML = "";
        }

    }
</script>
</body>
</html>