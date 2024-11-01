import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

async function cadastrarFuncionario(event) {
    // Dados form
    const form = event.target;
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (formValidate(form)) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "valor"
    const valor = formdata.get('valor');
    const valorSanitized = valor.replace(/[^\d,.]/g, '');
    formdata.set('valor', valorSanitized);

    // submit
    CadastroUtils.setSubmitButtonState(form, false);
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/lancamento.php',
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

    // reativar formButton
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
    // Filtro de input: moeda
    const form = document.querySelector('form.cadastro__form');
    const valor = form.querySelector('#valor');
    valor.addEventListener('input', InputUtils.currency.hook);

    // Submit subject
    const subject = CadastroUtils.createFormSubmitSubject(form);
    subject.subscribe(cadastrarFuncionario);
}

load();
