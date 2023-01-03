<?php require "header.php"; ?>

<form method="POST" class="ml-10 p-10">
    <input type="text" name="search" onkeyup="find()" placeholder="Taper votre recherche..." class="text-white bg-black p-2 pr-60" id="search">
</form>

<div class="result grid grid-cols-4 gap-x-14 p-40 text-center gap-y-14 pt-10 pb-10">

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