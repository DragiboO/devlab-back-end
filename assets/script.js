let hover = document.querySelector(".hover")
let add = document.querySelector(".add")
let out = document.querySelector(".ailleurs")


hover.addEventListener("click", function(){
    add.style.visibility = "visible"
    add.style.opacity = "1"
    add.style.transition = "opacity 0.5s ease-in-out"
})

out.addEventListener("click", function(){
    add.style.visibility = "hidden"
    add.style.opacity = "0"
    add.style.transition = "visibility 0s 0.5s, opacity 0.5s ease-in-out"
})