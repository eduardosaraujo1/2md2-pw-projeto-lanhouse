<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/base/base.css" />
    <link rel="stylesheet" href="../css/module/modules.css" />
    <link rel="stylesheet" href="../css/layout/login.css" />
</head>

<body>
    <div class="container">
        <div class="decorator-image"></div>
        <div class="login-container">
            <form method="post" novalidate>
                <div class="title">
                    <h1>Entrar</h1>
                    <h4 class="sub-heading">Digite suas credenciais para continuar</h4>
                </div>
                <input
                    class="input__box"
                    name="txtEmail"
                    id="txtEmail"
                    type="email"
                    placeholder="E-mail"
                    required />
                <input
                    class="input__box"
                    name="txtSenha"
                    id="txtSenha"
                    type="password"
                    placeholder="Senha"
                    required />
                <button
                    type="submit"
                    class="btn btn--primary"
                    id="btn-login">
                    Entrar
                </button>
            </form>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>

</html>