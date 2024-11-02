import { FormSenderFactory, CadastroUtils } from './common/cadastro.js';
import { InputUtils } from './common/input-utils.js';

async function cadastrarFornecedor(event) {
    const form = event.target;
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (formValidate(form)) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "telefone"
    CadastroUtils.setSubmitButtonState(form, false);
    const telefone = formdata.get('telefone');
    const telefoneFiltrado = telefone.replace(/\D/g, '');
    formdata.set('telefone', telefoneFiltrado);

    // submit
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/fornecedor.php',
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
    const telefone = form.querySelector('#telefone');

    if (!form.checkValidity()) {
        valid = false;
    }

    if (InputUtils.phone.isvalid(telefone.value)) {
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
    // Filtros de input
    const form = document.querySelector('form.cadastro__form');
    const telefone = form.querySelector('#telefone');
    telefone.addEventListener('input', InputUtils.phone.hook);

    // Evento submit
    const formSubject = CadastroUtils.createFormSubmitSubject(form);
    formSubject.subscribe(cadastrarFornecedor);
}

load();
