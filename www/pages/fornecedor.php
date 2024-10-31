<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Fornecedor - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/fornecedor.css" />
    <script>
        0
    </script>
</head>

<body>
    <?php include '../components/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de fornecedor</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form">
            <div class="cadastro__inputs">
                <div class="input-group">
                    <label class="input__label" for="nome">Nome</label>
                    <input
                        required
                        maxlength="50"
                        class="input__box"
                        type="text"
                        id="nome"
                        name="nome" />
                </div>
                <div class="input-group">
                    <label for="email" class="input__label">E-mail</label>
                    <input
                        required
                        placeholder="name@example.com"
                        maxlength="50"
                        class="input__box"
                        type="email"
                        id="email"
                        name="email" />
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="telefone" class="input__label">Telefone</label>
                        <input
                            required
                            placeholder="(00) 00000-0000"
                            class="input__box"
                            type="tel"
                            id="telefone"
                            name="telefone" />
                    </div>
                    <div class="input-group">
                        <label for="contato" class="input__label">Contato</label>
                        <input
                            required
                            maxlength="30"
                            class="input__box"
                            type="text"
                            id="contato"
                            name="contato" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="endereco" class="input__label">Endereco</label>
                    <input
                        required
                        maxlength="100"
                        class="input__box"
                        type="text"
                        id="endereco"
                        name="endereco" />
                </div>
            </div>
            <button type="submit" class="btn btn--primary" id="cadastro__button">
                Cadastrar
            </button>
        </form>
    </div>
    <script type="module" src="../js/fornecedor.js"></script>
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
    </script> -->
</body>

</html>