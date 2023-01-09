let btn_add_someone = document.querySelector(".btn_add_someone")
let menu_add_someone = document.querySelector(".menu_add_someone")

btn_add_someone.addEventListener("click", function () {
    menu_add_someone.classList.remove("hidden")
})

let close = document.querySelector('.close_menu')

close.addEventListener("click", function () {
    menu_add_someone.classList.add("hidden")
})

find_user()

function find_user() {

    let input = document.querySelector('.input');
    let user_research = document.querySelector(".user_research");

    if (input.value !== ''){

        axios.get('/page/class/user-research.php?user='+input.value)

            .then(function (response) {
                let users = response.data

                user_research.innerHTML = "";

                let max_research = users.length
                if (users.length > 50) {
                    max_research = 50
                }

                for (let i = 0; i <= max_research - 1; i++) {

                    let user = document.createElement("div");
                    user.classList += "user"
                    user.innerHTML += `<a href="/page/add-user.php?album=${album_id_js}&user=${users[i].id}" class="bg-orange-500 text-2xl px-2 py-1 rounded">${users[i].pseudo}</a>`
                    user_research.appendChild(user);
                }

            })
            .catch()
            .then();
    }else{
        user_research.innerHTML = "";
    }
}