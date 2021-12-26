let btnBuscar = document.querySelector("#btn-buscar");
let formBuscar = document.querySelector(".header .buscador");

btnBuscar.addEventListener("click", function () {
  btnBuscar.classList.toggle("fa-times");
  formBuscar.classList.toggle("activo");
  btnMenu.classList.remove("fa-times");
  navegacion.classList.remove("activo");
});

let btnMenu = document.querySelector("#btn-menu");
let navegacion = document.querySelector(".navegacion");

btnMenu.addEventListener("click", function () {
  btnMenu.classList.toggle("fa-times");
  navegacion.classList.toggle("activo");
  btnBuscar.classList.remove("fa-times");
  formBuscar.classList.remove("activo");
});

window.addEventListener("scroll", function () {
  btnBuscar.classList.remove("fa-times");
  formBuscar.classList.remove("activo");
  btnMenu.classList.remove("fa-times");
  navegacion.classList.remove("activo");
});
