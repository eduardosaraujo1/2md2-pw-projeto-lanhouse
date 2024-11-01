<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Categoria - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/categoria.css" />
    <script>
        0;
    </script>
</head>

<body>
    <?php include '../components/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de Categoria</h1>
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
                    <label class="input__label" for="nome">Descrição</label>
                    <textarea
                        maxlength="120"
                        rows="8"
                        class="input__box"
                        name="descricao"
                        id="descricao"></textarea>
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
    <script src="../js/cadastro.js"></script>
    <script>
        const form = document.querySelector('form');
        const endpointName = '<?php echo basename(__FILE__) ?>';
        // Form submit handle
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            if (!form.reportValidity()) {
                return;
            }

            await cadastroFormSubmit(form, endpointName);
        });
    </script>
</body>

</html>