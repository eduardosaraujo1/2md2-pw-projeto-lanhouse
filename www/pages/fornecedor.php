<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Fornecedor - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/fornecedor.css" />
    <script>
        0;
    </script>
</head>

<body>
    <?php include '../templates/navbar.html' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de fornecedor</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form">
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
                    <label for="email" class="input__label">E-mail</label>
                    <input
                        type="email"
                        class="input__box"
                        id="email"
                        name="email"
                        required
                        placeholder="name@example.com"
                        maxlength="50" />
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="telefone" class="input__label">Telefone</label>
                        <input
                            type="tel"
                            class="input__box"
                            id="telefone"
                            name="telefone"
                            required
                            placeholder="(00) 00000-0000" />
                    </div>
                    <div class="input-group">
                        <label for="contato" class="input__label">Contato</label>
                        <input
                            type="text"
                            class="input__box"
                            id="contato"
                            name="contato"
                            required
                            maxlength="30" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="endereco" class="input__label">Endereco</label>
                    <input
                        type="text"
                        class="input__box"
                        id="endereco"
                        name="endereco"
                        required
                        maxlength="100" />
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
    <script type="module" src="../js/fornecedor.js"></script>
</body>

</html>