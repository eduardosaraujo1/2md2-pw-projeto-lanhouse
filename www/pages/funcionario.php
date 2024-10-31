<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Funcionário - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/funcionario.css" />
    <script>
        0
    </script>
</head>

<body>
    <?php include '../components/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de funcionário</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form">
            <div class="cadastro__inputs">
                <div class="cadastro__row">
                    <div class="input-group">
                        <label class="input__label" for="nome">Nome</label>
                        <input type="text" class="input__box" id="nome" name="nome" maxlength="30" required />
                    </div>
                    <div class="input-group">
                        <label for="sobrenome" class="input__label">Sobrenome</label>
                        <input type="text" class="input__box" id="sobrenome" name="sobrenome" maxlength="30" required />
                    </div>
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="dt_nascimento" class="input__label">Data de Nascimento</label>
                        <input required class="input__box" type="date" id="dt_nascimento" name="dt_nascimento" />
                    </div>
                    <div class="input-group">
                        <label for="email" class="input__label">E-mail</label>
                        <input
                            required
                            placeholder="name@example.com"
                            maxlength="100"
                            class="input__box"
                            type="email"
                            id="email"
                            name="email" />
                    </div>
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="cargo" class="input__label">Cargo</label>
                        <input
                            maxlength="30"
                            required
                            class="input__box"
                            type="text"
                            id="cargo"
                            name="cargo" />
                    </div>
                    <div class="input-group">
                        <label for="salario" class="input__label">Salário </label>
                        <input
                            required
                            placeholder="R$ 99999,99"
                            data-currency-limit="5"
                            class="input__box"
                            type="text"
                            id="salario"
                            name="salario" />
                    </div>
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="senha" class="input__label">Senha</label>
                        <input
                            required
                            class="input__box"
                            type="password"
                            id="senha"
                            name="senha" />
                    </div>
                    <div class="input-group">
                        <label for="confirmSenha" class="input__label">Confirmar senha</label>
                        <input
                            required
                            class="input__box"
                            type="password"
                            id="confirmSenha" />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn--primary" id="cadastro__button">
                Cadastrar
            </button>
        </form>
    </div>
    <script type="module" src="../js/funcionario.js"></script>
    <!-- <script src="../js/cadastro.js"></script>
    <script src="../js/validate.js"></script> -->
    <!-- <script>
        const form = document.querySelector('form');
        const endpointName = '<?php echo basename(__FILE__) ?>';

        // Form submit handle
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (!form.reportValidity()) {
                return;
            }

            await cadastroFormSubmit(form, endpointName)
        });

        // password check
        const senha = document.querySelector("#senha");
        const confirmsenha = document.querySelector("#confirmSenha");
        const passHandler = (event) => {
            if (senha.value === confirmsenha.value) {
                senha.setCustomValidity("");
                confirmsenha.setCustomValidity("");
            } else {
                senha.setCustomValidity("Senhas não coincidem");
                confirmsenha.setCustomValidity("Senhas não coincidem");
            }
        }
        senha.addEventListener("input", passHandler);
        confirmsenha.addEventListener("input", passHandler);
    </script> -->
</body>

</html>