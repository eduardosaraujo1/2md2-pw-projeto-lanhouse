import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

// Filtro de input: telefone
const telefone = document.querySelector('#telefone');
telefone.addEventListener('input', InputUtils.phone.hook);
