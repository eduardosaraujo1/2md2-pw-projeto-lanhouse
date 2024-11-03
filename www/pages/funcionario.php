<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require '../php/session/session-validate.php' ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Funcionário - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/funcionario.css" />
    <script>
        0;
    </script>
</head>

<body>
    <?php include '../templates/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Cadastro de funcionário</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form" action="../php/database/insert/funcionario.php">
            <div class="cadastro__inputs">
                <div class="cadastro__row">
                    <div class="input-group">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            type="text"
                            class="input__box"
                            id="nome"
                            name="nome"
                            maxlength="30"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="sobrenome" class="input__label">Sobrenome</label>
                        <input
                            type="text"
                            class="input__box"
                            id="sobrenome"
                            name="sobrenome"
                            maxlength="30"
                            required />
                    </div>
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="dt_nascimento" class="input__label">Data de Nascimento</label>
                        <input
                            type="date"
                            class="input__box"
                            id="dt_nascimento"
                            name="dt_nascimento"
                            required />
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
                            maxlength="100" />
                    </div>
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="cargo" class="input__label">Cargo</label>
                        <input
                            type="text"
                            class="input__box"
                            id="cargo"
                            name="cargo"
                            maxlength="30"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="salario" class="input__label">Salário
                        </label>
                        <input
                            type="text"
                            class="input__box"
                            id="salario"
                            name="salario"
                            required
                            placeholder="R$ 99999,99"
                            data-maxlength="7" />
                    </div>
                </div>
                <div class="cadastro__row">
                    <div class="input-group">
                        <label for="senha" class="input__label">Senha</label>
                        <input
                            type="password"
                            class="input__box"
                            id="senha"
                            name="senha"
                            required />
                    </div>
                    <div class="input-group">
                        <label for="confirmSenha" class="input__label">Confirmar senha</label>
                        <input
                            type="password"
                            class="input__box"
                            id="confirmSenha"
                            required />
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
    <script type="module" src="../js/funcionario.js"></script>
</body>

</html>