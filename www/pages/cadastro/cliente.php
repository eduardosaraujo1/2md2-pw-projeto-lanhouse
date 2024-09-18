<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="..">
    <title>Cadastrar Cliente - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../static/css/base/base.css" />
    <link rel="stylesheet" href="../static/css/module/modules.css" />
    <link rel="stylesheet" href="../static/css/layout/cliente.css" />
</head>

<body>

    <?php include '../../components/navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Cliente</h1>
            <span class="submit-result"></span>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input">
                        <label for="nome" class="input__label">Nome</label>
                        <input
                            required
                            maxlength="30"
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input">
                        <label for="sobrenome" class="input__label" for="">Sobrenome</label>
                        <input
                            required
                            maxlength="30"
                            class="input__box"
                            type="text"
                            id="sobrenome"
                            name="sobrenome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="email" class="input__label">E-mail</label>
                        <input
                            required
                            maxlength="100"
                            class="input__box"
                            type="text"
                            id="email"
                            name="email" />
                    </div>
                    <div class="input">
                        <label for="telefone" class="input__label">Telefone</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="telefone"
                            name="telefone" />
                    </div>
                    <div class="input">
                        <label for="endereco" class="input__label">Endereço</label>
                        <input
                            required
                            maxlength="100"
                            class="input__box"
                            type="text"
                            id="endereco"
                            name="endereco" />
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn--primary">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>
    <script src="../js/cadastro.js"></script>
    <script src="../js/validate.js"></script>
    <script>
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

        // validate telefone
        const telefone = document.querySelector("#telefone");
        telefone.addEventListener("input", (event) => {
            TelefoneValidate.inputFilter(telefone);

            const full = TelefoneValidate.validate(telefone.value)
            if (full) {
                telefone.setCustomValidity("");
            } else {
                telefone.setCustomValidity("Telefone inválido");
            }
        });
    </script>
</body>

</html>