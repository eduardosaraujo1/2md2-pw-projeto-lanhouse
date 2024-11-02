import { InputUtils } from './common/inpututils.js';
import Cadastro from './common/cadastro.js';

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
    Cadastro.setSubmitButtonState(form, false);
    const result = await Cadastro.cadastrar('../php/database/insert/lancamento.php', formdata);

    // exibir resposta para o usuário
    const cadastroResult = document.querySelector('.cadastro__result');
    Cadastro.displayResponseResult(cadastroResult, result['status'] === 'success');

    // limpar form quando subject sucesso
    if (result['status'] === 'success') {
        form.reset();
    }

    // reativar formButton
    Cadastro.setSubmitButtonState(form, true);
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
    const subject = Cadastro.createFormSubmitSubject(form);
    subject.subscribe(cadastrarFuncionario);
}

load();
