import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

// Filtro de input: moeda
const salario = document.querySelector('#salario');
salario.addEventListener('input', InputUtils.currency.hook);

// Criar form subject
const form = document.querySelector('form.cadastro__form');
const formSubject = CadastroUtils.createFormSubmitSubject(form);

// Validação senha confirmar senha
/**
 *
 * @param {SubmitEvent} event
 */
function passwordCheck(event) {
    const form = event.target;
    const password = form.querySelector('#senha');
    const confirmPassword = form.querySelector('#confirmSenha');

    if (password.value !== confirmPassword.value) {
        password.setCustomValidity('Senhas não coincidem');
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity após exibir o problema para permitir um segundo reenvio
    password.setCustomValidity('');
}

formSubject.subscribe(passwordCheck);
