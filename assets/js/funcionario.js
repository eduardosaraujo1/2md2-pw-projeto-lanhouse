import { FormSenderFactory, CadastroUtils } from './common/cadastro.mjs';
import { InputUtils } from './common/inpututils.mjs';

function getFormData(form) {
    // Dados form
    const formdata = new FormData(form);

    // Sanitizar salario
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // Retornar FormData
    return formdata;
}

/**
 * @param {HTMLFormElement} form
 */
function formValidate(form) {
    let valid = true;
    const senha = form.querySelector('#senha');
    const confirmSenha = form.querySelector('#confirmSenha');

    if (senha.value.length < 8) {
        valid = false;
        senha.setCustomValidity('Senha deve ter 8 ou mais caracteres');
    }

    if (senha.value !== confirmSenha.value) {
        valid = false;
        senha.setCustomValidity('Senhas não coincidem');
    }

    if (!form.checkValidity()) {
        valid = false;
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity para permitir proximos envios
    senha.setCustomValidity('');

    // Retornar se é valido ou não
    return valid;
}

function load() {
    // Cadastro elements
    const form = document.querySelector('form.cadastro__form');

    // Form sender object
    const formSender = FormSenderFactory(form, formValidate, getFormData);

    form.addEventListener('submit', async (event) => {
        // Prevent form submit default redirection behaviour
        event.preventDefault();

        // Default cadastro submit logic
        CadastroUtils.cadastroSubmitHandler(formSender);
    });

    // Filtros de entrada de texto
    const salario = form.querySelector('#salario');
    salario.addEventListener('input', InputUtils.currency.hook);
}

load();
