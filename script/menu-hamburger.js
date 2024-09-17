/* -------------------------Menu Hamburger----------------------------------- */

function toggleMenu() {
  var menu = document.querySelector(".lien-page-header");
  var hamburger = document.querySelector(".hamburger");
  menu.classList.toggle("active");

  // Basculer la classe "cross" du bouton hamburger pour afficher la croix
  if (hamburger.classList.contains("cross")) {
    hamburger.classList.remove("cross");
    hamburger.innerHTML = "&#9776;"; // Symbole du menu hamburger
  } else {
    hamburger.classList.add("cross");
    hamburger.innerHTML = "&#10006;"; // Symbole de la croix
  }
}
