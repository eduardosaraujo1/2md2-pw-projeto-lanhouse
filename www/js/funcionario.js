import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

async function cadastrarFuncionario(event) {
    // Dados form
    const form = event.target;
    const formdata = new FormData(form);
    const senha = form.querySelector('#senha');
    const confirmSenha = form.querySelector('#confirmSenha');

    // cancelar envio em caso de invalidez
    if (
        !form.checkValidity() ||
        !InputUtils.password.isvalid(senha.value, confirmSenha.value)
    ) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "salario"
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // submit
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/funcionario.php',
        formdata
    );

    // exibir resposta para o usuário
    const cadastroResult = document.querySelector('.cadastro__result');
    CadastroUtils.displayResponseResult(
        cadastroResult,
        result['status'] === 'success'
    );
}

function passwordSubmitHook(event) {
    // Propriedades do formulario enviado
    const form = event.target;
    const senha = form.querySelector('#senha');
    const confirmSenha = form.querySelector('#confirmSenha');

    // Validar senha utilizando InputUtils
    const valid = InputUtils.password.isvalid(senha.value, confirmSenha.value);

    if (!valid) {
        if (senha.value.length < 8) {
            senha.setCustomValidity('Senha deve ter 8 ou mais caracteres');
        } else {
            senha.setCustomValidity('Senhas não coincidem');
        }
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity para permitir proximos envios
    senha.setCustomValidity('');
}

function load() {
    // Filtros de entrada de texto
    const form = document.querySelector('form.cadastro__form');
    const salario = form.querySelector('#salario');
    salario.addEventListener('input', InputUtils.currency.hook);

    // Conectar funções ao evento "form submit"
    const formSubject = CadastroUtils.createFormSubmitSubject(form);
    formSubject.subscribe(passwordSubmitHook);
    formSubject.subscribe(cadastrarFuncionario);
}

load();
