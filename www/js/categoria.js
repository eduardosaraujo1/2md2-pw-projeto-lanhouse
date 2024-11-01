import CadastroUtils from './common/cadastro.js';

async function cadastrarCategoria(event) {
    /** @type {HTMLFormElement} */
    const form = event.target;
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (!form.checkValidity()) {
        return;
    }

    // submit
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
}

function load() {
    const form = document.querySelector('form.cadastro__form');
    const subject = CadastroUtils.createFormSubmitSubject(form);
    subject.subscribe(cadastrarCategoria);
}
load();
