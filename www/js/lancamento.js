import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

// Filtro de input: moeda
const valor = document.querySelector('#valor');
valor.addEventListener('input', InputUtils.currency.hook);
