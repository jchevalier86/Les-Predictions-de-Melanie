/* -------------------------Effets Textes et Photos----------------------------------- */

// Ce script s'exécute également une fois que le DOM est entièrement chargé et prêt
document.addEventListener("DOMContentLoaded", () => {
  // Sélectionne les éléments avec des classes spécifiques pour les afficher
  const presentation = document.querySelector(".presentation");
  const photoBody = document.querySelector(".photo-body");

  // Vérifie et ajoute la classe "show" si les éléments existent
  if (presentation) {
    presentation.classList.add("show");
  }
  if (photoBody) {
    photoBody.classList.add("show");
  }
});
