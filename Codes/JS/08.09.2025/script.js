import procedural from "./modules/procedural.js";
import functional from "./modules/functional.js";
import reactive from "./modules/reactive.js"

document.querySelector('.procedural')
.addEventListener ('click', procedural)

document.querySelector('.functional')
.addEventListener('click', functional)

document.querySelector('.reactive')
.addEventListener('click', reactive)