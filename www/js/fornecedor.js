import { FormSenderFactory, CadastroUtils } from './common/cadastro.mjs';
import { InputUtils } from './common/inpututils.mjs';

function getFormData(form) {
    // Declare FormData
    const formdata = new FormData(form);

    // Sanitizar Telefone
    const telefone = formdata.get('telefone');
    const telefoneFiltrado = telefone.replace(/\D/g, '');
    formdata.set('telefone', telefoneFiltrado);

    // Retornar FormData
    return formdata;
}

function formValidate(form) {
    let valid = true;
    const telefone = form.querySelector('#telefone');

    if (!form.checkValidity()) {
        valid = false;
    }

    if (!InputUtils.phone.isvalid(telefone.value)) {
        telefone.setCustomValidity('Telefone incompleto.');
        valid = false;
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Remover customvalidity para permitir proximos submits
    telefone.setCustomValidity('');

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

    // Filtros de input
    const telefone = form.querySelector('#telefone');
    telefone.addEventListener('input', InputUtils.phone.hook);
}

load();
