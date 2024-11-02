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
        <h1 class="cadastro__title">Cadastro de categoria</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form" action="../php/database/insert/categoria.php">
            <div class="cadastro__inputs">
                <div class="input-group">
                    <label class="input__label" for="nome">Nome</label>
                    <input
                        type="text"
                        class="input__box"
                        id="nome"
                        name="nome"
                        required
                        maxlength="50" />
                </div>
                <div class="input-group">
                    <label class="input__label" for="descricao">Descrição</label>
                    <textarea
                        class="input__box"
                        id="descricao"
                        name="descricao"
                        maxlength="120"
                        rows="8"></textarea>
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
    <script type="module" src="../js/categoria.js"></script>
</body>

</html>