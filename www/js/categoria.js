import CadastroUtils from './common/cadastro.js';

async function cadastrarCategoria(event) {
    /** @type {HTMLFormElement} */
    const form = event.target;
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (formValidate(form)) {
        return;
    }

    // submit
    CadastroUtils.setSubmitButtonState(form, false);
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/categoria.php',
        formdata
    );

    // exibir resposta para o usuário
    const cadastroResult = document.querySelector('.cadastro__result');
    CadastroUtils.displayResponseResult(
        cadastroResult,
        result['status'] === 'success'
    );

    // limpar form quando subject sucesso
    if (result['status'] === 'success') {
        form.reset();
    }
    CadastroUtils.setSubmitButtonState(form, true);
}

function formValidate(form) {
    let valid = true;

    if (!form.checkValidity()) {
        valid = false;
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Retornar se é valido ou não
    return valid;
}

function load() {
    const form = document.querySelector('form.cadastro__form');
    const subject = CadastroUtils.createFormSubmitSubject(form);
    subject.subscribe(cadastrarCategoria);
}
load();
