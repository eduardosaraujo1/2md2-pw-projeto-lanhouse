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
    <?php include 'components/navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Funcionário</h1>
            <span class="submit-result"></span>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input col-span-2">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            required
                            maxlength="30"
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="sobrenome" class="input__label">Sobrenome</label>
                        <input
                            required
                            maxlength="30"
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
                            maxlength="100"
                            class="input__box"
                            type="email"
                            id="email"
                            name="email" />
                    </div>
                    <div class="input col-span-3">
                        <label for="cargo" class="input__label">Cargo</label>
                        <input
                            maxlength="30"
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
    <script src="./js/cadastro.js"></script>
    <script src="./js/formValidate.js"></script>
    <script>
        const form = document.querySelector('form');
        const button = form.querySelector('button');
        const resultSpan = document.querySelector(".submit-result");

        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            if (!form.reportValidity()) {
                return;
            }

            button.disabled = true;
            const formdata = new FormData(form);
            const responseObject = await postFormData('database/insert/funcionario.php', formdata);
            button.disabled = false;
            displaySubmitResult(responseObject, resultSpan);
        })

        // salario validation
        const salarioInput = document.querySelector("#salario");
        salarioInput.addEventListener("input", (event) => {
            InputFilter.currency(event.currentTarget);

            const currencyRegex = /^\d{1,5}([,.]\d{2})?$/;
            const valid = currencyRegex.test(salarioInput.value);
            if (valid) {
                salarioInput.setCustomValidity("");
            } else {
                salarioInput.setCustomValidity("Salário inválido");
            }
        })
    </script>
</body>

</html>