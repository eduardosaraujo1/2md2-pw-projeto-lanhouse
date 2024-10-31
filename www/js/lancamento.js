import InputUtils from './common/input-utils.js';

// Filtro de input: moeda
const valor = document.querySelector('#valor');
valor.addEventListener('input', InputUtils.currency.hook);
