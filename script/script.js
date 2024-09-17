/* -------------------------Effets Textes et Photos----------------------------------- */

// Ce script s'exécute également une fois que le DOM est entièrement chargé et prêt
document.addEventListener("DOMContentLoaded", () => {
  // Sélectionne les éléments avec des classes spécifiques pour les afficher
  const presentation = document.querySelector(".presentation");
  const photoBody = document.querySelector(".photo-body");
  const photoBody1 = document.querySelector(".photo-body-1");
  const photoBody2 = document.querySelector(".photo-body-2");
  const photoBody3 = document.querySelector(".photo-body-3");

  // Vérifie et ajoute la classe "show" si les éléments existent
  if (presentation) {
    presentation.classList.add("show");
  }
  if (photoBody) {
    photoBody.classList.add("show");
  }
  if (photoBody1) {
    photoBody1.classList.add("show");
  }
  if (photoBody2) {
    photoBody2.classList.add("show");
  }
  if (photoBody3) {
    photoBody3.classList.add("show");
  }
});
