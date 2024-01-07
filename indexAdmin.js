const navLinks = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll('.section');
const adminTitle = document.querySelector(".adminTitle");

const historyBtn = document.querySelector(".historyBtn");
const medicinesBtn = document.querySelector('.medicinesBtn');
const usersBtn = document.querySelector('.usersBtn');
const adminsBtn = document.querySelector('.adminsBtn');
const addMedBtn = document.querySelector(".addMedBtn");

const history = document.querySelector(".history");
const medicines = document.querySelector(".medicines");
const users = document.querySelector(".users");
const admins = document.querySelector(".admins");

navLinks.forEach(element => {
    element.onclick = function() {
        navLinks.forEach(element => {
            element.classList.remove("active");
            sections.forEach(section => {
                section.classList.add("hidden");
                addMedBtn.classList.add("hidden");
            })
        })
        this.classList.toggle("active");
    }
});

historyBtn.addEventListener("click", function() {
    history.classList.remove("hidden");
    adminTitle.textContent = "History";
});
medicinesBtn.addEventListener("click", function() {
    addMedBtn.classList.remove("hidden");
    medicines.classList.remove("hidden");
    adminTitle.textContent = "Medicines";
});
usersBtn.addEventListener("click", function() {
    users.classList.remove("hidden");
    adminTitle.textContent = "Users";
});
adminsBtn.addEventListener("click", function() {
    admins.classList.remove("hidden");
    adminTitle.textContent = "Admins";
});

function deleteMedicine(idNum) {
    const addMedForm = document.querySelector(".addMedForm");
    addMedForm.action = `includes/medDelete.php?medID=${idNum}`;
    addMedForm.submit();
}

const darken = document.querySelector(".darken");
const newMedForm = document.querySelector(".newMedForm");
console.log(newMedForm);
addMedBtn.addEventListener("click", function() {
    darken.classList.toggle("hidden");
    newMedForm.classList.toggle("hidden");
})