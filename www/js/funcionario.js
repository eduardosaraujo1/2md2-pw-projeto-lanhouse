import InputUtils from './common/input-utils.js';

// Filtro de input: moeda
const salario = document.querySelector('#salario');
salario.addEventListener('input', InputUtils.currency.hook);
