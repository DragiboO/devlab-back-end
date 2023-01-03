<?php require "header.php"; ?>

<form method="POST">
    <input type="text" name="search" onkeyup="find()" placeholder="Taper votre recherche..." class="text-black" id="search">
    <input type="submit">
</form>

<div class="result">

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

                    for (let i = 0; i <= 4; i++) {
                        let result = document.createElement("li");
                        let myLink = "single.php?id="+movie[i].id
                        result.innerHTML = "<p><a href="+myLink+">"+movie[i].original_title+"</a></p>"
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