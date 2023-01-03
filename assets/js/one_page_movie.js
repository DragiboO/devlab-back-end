let add_movie_list = document.querySelector(".add_btn")
let menu_add_movie_list = document.querySelector(".menu_add")

add_movie_list.addEventListener("click", function () {
    menu_add_movie_list.classList.remove("hidden")
})

let close = document.querySelector(".sub_menu_add")
let close_2 = document.querySelector(".menu_add")

close.addEventListener("click", function () {
    menu_add_movie_list.classList.add("hidden")
})

close_2.addEventListener("click", function () {
    close.click()
})



