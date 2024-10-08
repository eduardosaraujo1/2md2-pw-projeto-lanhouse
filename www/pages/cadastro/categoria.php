<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="..">
    <title>Cadastrar Categoria - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/base/base.css" />
    <link rel="stylesheet" href="../css/module/modules.css" />
    <link rel="stylesheet" href="../css/layout/categoria.css" />
</head>

<body>
    <?php include '../../components/navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Categoria</h1>
            <span class="submit-result"></span>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            required
                            maxlength="50"
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input input--textarea">
                        <label class="input__label" for="nome">Descrição</label>
                        <textarea
                            maxlength="120"
                            class="input__box"
                            name="descricao"
                            id="descricao"></textarea>
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