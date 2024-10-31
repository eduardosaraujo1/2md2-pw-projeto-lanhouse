<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Cliente - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/cliente.css" />

    <script>
        0
    </script>
</head>

<body>
    <?php include '../components/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de Cliente</h1>
        <span class="cadastro__title"></span>
        <form class="cadastro__form">
            <div class="cadastro__inputs">
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="nome" class="input__label">Nome</label>
                        <input
                            required
                            maxlength="30"
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input-group">
                        <label for="sobrenome" class="input__label" for="">Sobrenome</label>
                        <input
                            required
                            maxlength="30"
                            class="input__box"
                            type="text"
                            id="sobrenome"
                            name="sobrenome" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="email" class="input__label">E-mail</label>
                    <input
                        placeholder="name@example.com"
                        required
                        maxlength="100"
                        class="input__box"
                        type="text"
                        id="email"
                        name="email" />
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="telefone" class="input__label">Telefone</label>
                        <input
                            placeholder="(00) 00000-0000"
                            required
                            class="input__box"
                            type="text"
                            id="telefone"
                            name="telefone" />
                    </div>
                    <div class="input-group">
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
            </div>
            <button
                type="submit"
                class="btn btn--primary"
                id="cadastro__button">
                Cadastrar
            </button>
        </form>
    </div>
    <script type="module" src="../js/cliente.js"></script>
    <!-- <script src="../js/cadastro.js"></script>
    <script src="../js/validate.js"></script> -->
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
    </script>
</body>

</html>