import { InputUtils } from './common/inpututils.mjs';
import { FormSenderFactory, CadastroUtils } from './common/cadastro.mjs';
import Database from './common/database.mjs';

async function getCategorias() {
    const endpoint = '../php/database/select/categorias.php';
    const response = await Database.sendGet(endpoint);

    if (response.status !== 'success') {
        return {};
    }

    return response.content;
}

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
    let valid = true;
    const select = form.querySelector('#categoria');
    if (select.value === '') {
        select.setCustomValidity('Selecione uma categoria.');
        valid = false;
    }

    if (!form.reportValidity()) {
        valid = false;
    }

    select.setCustomValidity('');

    return valid;
}

async function load() {
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

    // Alimentar select de categorias
    // const categoriaSelect = form.querySelector('#categoria');
    // const categorias = await getCategorias();
    // for (const key in categorias) {
    //     const option = document.createElement('option');
    //     option.value = key;
    //     option.innerHTML = categorias[key];
    //     categoriaSelect.appendChild(option);
    // }
}

load();
