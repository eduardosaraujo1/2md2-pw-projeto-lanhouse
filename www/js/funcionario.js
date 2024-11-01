import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

// Filtro de input: moeda
const salario = document.querySelector('#salario');
salario.addEventListener('input', InputUtils.currency.hook);

// Elementos cadastro
const cadastroResult = document.querySelector('.cadastro__result');

// Criar form subject (observers)
const form = document.querySelector('form.cadastro__form');
const formSubject = CadastroUtils.createFormSubmitSubject(form);

/**
 * Validar campos "Senha" e "Confirmar Senha"
 *
 * @param {SubmitEvent} event
 */
function passwordCheck(event) {
    const password = form.querySelector('#senha');
    const confirmPassword = form.querySelector('#confirmSenha');

    if (password.value !== confirmPassword.value) {
        password.setCustomValidity('Senhas não coincidem');
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity para permitir proximos envios
    password.setCustomValidity('');
}

async function cadastrarFuncionario(event) {
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (!form.checkValidity() || !validatePassword()) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "salario"
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // submit
    console.log(formdata);
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/funcionario.php',
        formdata
    );

    cadastroResult.innerHTML = JSON.stringify(result);

    function validatePassword() {
        const passwordValue = form.querySelector('#senha').value;
        const confirmValue = form.querySelector('#confirmSenha').value;
        return passwordValue === confirmValue;
    }
}

// subscribes
formSubject.subscribe(passwordCheck);
formSubject.subscribe(cadastrarFuncionario);
