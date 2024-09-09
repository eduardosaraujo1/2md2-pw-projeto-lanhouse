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
    <script>
        0
    </script>
    <?php include 'navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Funcionário</h1>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input col-span-2">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="sobrenome" class="input__label">Sobrenome</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="sobrenome"
                            name="sobrenome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="dtNascimento" class="input__label">Data de Nascimento</label>
                        <input
                            required
                            class="input__box"
                            type="date"
                            id="dtNascimento"
                            name="dtNascimento" />
                    </div>
                    <div class="input col-span-6">
                        <label for="email" class="input__label">E-mail</label>
                        <input
                            required
                            class="input__box"
                            type="email"
                            id="email"
                            name="email" />
                    </div>
                    <div class="input col-span-3">
                        <label for="cargo" class="input__label">Cargo</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="cargo"
                            name="cargo" />
                    </div>
                    <div class="input col-span-3">
                        <label for="salario" class="input__label">Salário (R$)</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="salario"
                            name="salario" />
                    </div>
                    <div class="input col-span-3">
                        <label for="senha" class="input__label">Senha</label>
                        <input
                            required
                            class="input__box"
                            type="password"
                            id="senha"
                            name="senha" />
                    </div>
                    <div class="input col-span-3">
                        <label for="confirmSenha" class="input__label">Confirmar senha</label>
                        <input
                            required
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
    <script src="./js/database.js"></script>
    <script src="./js/formValidate.js">
    </script>
    <script>
        // keypress filter for salario
        const form = document.querySelector('form');
        const salario = form.querySelector('#salario');
        salario.addEventListener('input', currencyFilter);

        // form validation
        function validate() {
            if (!validCurrency(salario.value)) {
                salario.setCustomValidity('Salário não é válido')
            }
            // Verificar se a senha é igual a confirmSenha
            const senha = document.getElementById("senha");
            const confirmsenha = document.getElementById("confirmSenha");
            if (senha?.value !== confirmsenha?.value) {
                confirmsenha.setCustomValidity('Senhas não são iguais')
            }
        }

        setupCadastroSubmit(form, 'insert_funcionario.php', validate);
    </script>
</body>

</html>