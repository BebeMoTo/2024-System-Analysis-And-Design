const navLinks = document.querySelectorAll(".nav-link");
const registerForm = document.querySelector(".register-form");
const id = document.querySelector(".id");
const adminForm = document.querySelector(".admin-form");
const admin = document.querySelector(".admin");
const darken = document.querySelector(".darken");
const developers = document.querySelector(".developers");
const developerButton = document.querySelector(".developer-button");

navLinks.forEach(element => {
    element.onclick = function() {
        navLinks.forEach(element => {
            element.classList.remove("active");
            registerForm.classList.add("hidden");
            adminForm.classList.add("hidden");
            darken.classList.add("hidden");
            developers.classList.add("hidden");
        })
        this.classList.toggle("active");
    }
});

id.addEventListener("click", function() {
    registerForm.classList.remove("hidden");
    darken.classList.remove("hidden");
});
admin.addEventListener("click", function() {
    adminForm.classList.remove("hidden");
    darken.classList.remove("hidden");
})
developerButton.addEventListener("click", function() {
    developers.classList.remove("hidden");
    darken.classList.remove("hidden");
})