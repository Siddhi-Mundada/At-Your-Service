const toggleButton = document.getElementsByClassName('toggle-button')[0];
const navbarItems = document.getElementsByClassName('navbar-items')[0];

toggleButton.addEventListener('click', () => {
    navbarItems.classList.toggle('active'); 
})

navbarItems.forEach(n => n.addEventListener("click", closeMenu));

function closeMenu() {
    toggleButton.classList.remove("active");
    navbarItems.classList.remove("active");
}