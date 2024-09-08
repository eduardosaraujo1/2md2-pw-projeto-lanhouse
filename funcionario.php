<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Funcionário - Sistema Lanhouse</title>
    <link rel="stylesheet" href="css/base/base.css" />
    <link rel="stylesheet" href="css/module/modules.css" />
    <link rel="stylesheet" href="./css/layout/funcionario.css" />
</head>

<body>
    <?php include 'navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Funcionário</h1>
            <form
                class="cadastro-form"
                action="php/insert_funcionario.php"
                method="post">
                <div class="cadastro-form__inputs">
                    <div class="input col-span-2">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="sobrenome" class="input__label">Sobrenome</label>
                        <input
                            class="input__box"
                            type="text"
                            id="sobrenome"
                            name="sobrenome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="data-nascimento" class="input__label">Data de Nascimento</label>
                        <input
                            class="input__box"
                            type="date"
                            id="data-nascimento"
                            name="data-nascimento" />
                    </div>
                    <div class="input col-span-6">
                        <label for="email" class="input__label">E-mail</label>
                        <input
                            class="input__box"
                            type="email"
                            id="email"
                            name="email" />
                    </div>
                    <div class="input col-span-3">
                        <label for="cargo" class="input__label">Cargo</label>
                        <input
                            class="input__box"
                            type="text"
                            id="cargo"
                            name="cargo" />
                    </div>
                    <div class="input col-span-3">
                        <label for="salario" class="input__label">Salário (R$)</label>
                        <input
                            class="input__box"
                            type="text"
                            id="salario"
                            name="salario" />
                    </div>
                    <div class="input col-span-3">
                        <label for="senha" class="input__label">Senha</label>
                        <input
                            class="input__box"
                            type="password"
                            id="senha"
                            name="senha" />
                    </div>
                    <div class="input col-span-3">
                        <label for="confirmSenha" class="input__label">Confirmar senha</label>
                        <input
                            class="input__box"
                            type="password"
                            id="confirmSenha" />
                    </div>
                </div>
                <button type="submit" class="btn btn--primary">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>
    <script>
        // TODO: Verificar se a senha é igual a confirmSenha
        function allowOnlyCurrency(e) {
            const key = e.key;
            const inputField = e.target;
            const currentValue = inputField.value;

            // Permitir botões Tab e Apagar
            if (key === 'Backspace' || key === 'Tab') {
                return;
            }

            // BLOQUEAR digitar se já estiver completo o formato de salário
            // REGEX: essa expressão verifica se o valor digitado termina com uma virgula (ou ponto) e duas casas decimais
            // Se quiser entender mais, pergunte ao ChatGPT "Me explique o REGEX /[,.]\d{2}$/g"
            if (/[,.]\d{2}$/g.test(currentValue)) {
                e.preventDefault();
                return;
            }

            // Permitir uma virgula ou ponto se não já estiver presente
            if (key === ',' || key === '.') {
                const temPonto = currentValue.includes('.');
                const temVirgula = currentValue.includes(',');
                if (!temPonto && !temVirgula) {
                    return;
                }
            }

            // Permitir números
            if (!isNaN(key)) {
                return;
            }

            e.preventDefault();
        }
        document
            .getElementById('salario')
            .addEventListener('keypress', allowOnlyCurrency);
    </script>
</body>

</html>