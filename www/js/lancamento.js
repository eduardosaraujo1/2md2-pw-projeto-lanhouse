import { InputUtils } from './common/inpututils.mjs';
import { FormSenderFactory, CadastroUtils } from './common/cadastro.mjs';

function getFormData(form) {
    // Declare FormData
    const formdata = new FormData(form);

    // Sanitizar valor
    const valor = formdata.get('valor');
    const valorSanitized = valor.replace(/[^\d,.]/g, '');
    formdata.set('valor', valorSanitized);

    // Adicionar debug flag
    // formdata.set('debug', 'true');

    // Retornar FormData
    return formdata;
}

function formValidate(form) {
    // Exibir problema caso exista
    return form.reportValidity();
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

    // Filtro de input: moeda
    const valor = form.querySelector('#valor');
    valor.addEventListener('input', InputUtils.currency.hook);
}

load();
