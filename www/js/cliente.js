import { InputUtils } from './common/input-utils.js';
import { FormSenderFactory, CadastroUtils } from './common/cadastro.js';

async function cadastrarCliente(event) {
    const form = event.target;
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (formValidate(form)) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "telefone"
    const telefone = formdata.get('telefone');
    const telefoneFiltrado = telefone.replace(/\D/g, '');
    formdata.set('telefone', telefoneFiltrado);

    // submit
    CadastroUtils.setSubmitButtonState(form, false);
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/cliente.php',
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

    if (InputUtils.phone.isvalid(telefone.value)) {
        telefone.setCustomValidity('Telefone incompleto.');
        valid = false;
    }

    if (!form.checkValidity()) {
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
    // Filtro de input: telefone
    const form = document.querySelector('form.cadastro__form');
    const telefone = form.querySelector('#telefone');
    telefone.addEventListener('input', InputUtils.phone.hook);

    // Conectar método ao submit listener
    const subject = CadastroUtils.createFormSubmitSubject(form);
    subject.subscribe(cadastrarCliente);
}

load();
