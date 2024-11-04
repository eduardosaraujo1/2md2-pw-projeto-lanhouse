<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../src/session/check.php' ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Cliente - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../assets/css/cliente.css" />
    <script>
        0;
    </script>
</head>

<body>
    <?php include '../templates/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de cliente</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form" action="../php/database/insert/cliente.php">
            <div class="cadastro__inputs">
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="nome" class="input__label">Nome</label>
                        <input
                            type="text"
                            class="input__box"
                            id="nome"
                            name="nome"
                            required
                            maxlength="30" />
                    </div>
                    <div class="input-group">
                        <label for="sobrenome" class="input__label" for="">Sobrenome</label>
                        <input
                            type="text"
                            class="input__box"
                            id="sobrenome"
                            name="sobrenome"
                            required
                            maxlength="30" />
                    </div>
                </div>
                <div class="input-group">
                    <label for="email" class="input__label">E-mail</label>
                    <input
                        type="text"
                        class="input__box"
                        id="email"
                        name="email"
                        placeholder="name@example.com"
                        required
                        maxlength="100" />
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="telefone" class="input__label">Telefone</label>
                        <input
                            type="text"
                            class="input__box"
                            id="telefone"
                            name="telefone"
                            placeholder="(00) 00000-0000"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="endereco" class="input__label">Endereço</label>
                        <input
                            type="text"
                            class="input__box"
                            id="endereco"
                            name="endereco"
                            required
                            maxlength="100" />
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
    <script type="module" src="../assets/js/cliente.js"></script>
</body>

</html>