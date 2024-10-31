import InputUtils from './common/input-utils.js';

// Filtro de input: telefone
const telefone = document.querySelector('#telefone');
telefone.addEventListener('input', InputUtils.phone.hook);
