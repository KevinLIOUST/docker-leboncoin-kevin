// -------------------------- Pour la gestion du menu burger dans le header ! :) ------------------------------

// La balise "nav" qui a des enfants balises "li", j'aimerais sélectionner les enfants balises "li"
// C'est comme un selecteur CSS
const links = document.querySelectorAll('nav li');

// On ajoute un événement click pour faire apparaître le menu en cliquant sur le menu burger et le refermer grâce à un toggle
icons.addEventListener("click", () => {
    nav.classList.toggle("active");
});

// Pour chaque lien, on ajoute un événement qui fait disparaître le menu
links.forEach((link) => {
    link.addEventListener("click", () => {
        nav.classList.remove("active");
    })
})