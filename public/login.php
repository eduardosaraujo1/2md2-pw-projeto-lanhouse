<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../assets/css/login.css" />
    <script>
        0;
    </script>
</head>

<body>
    <div class="decorator-image"></div>
    <div class="form-container">
        <form class="form" method="post" action="../php/session/logon.php">
            <div class="title">
                <h1 class="font-heading">Entrar</h1>
                <span class="font-regular">Digite suas credenciais para continuar</span>
            </div>
            <input type="email" class="input__box" id="email" name="email" placeholder="E-mail" required />
            <input type="password" class="input__box" id="senha" name="senha" placeholder="Senha" required />
            <span class="login__result"></span>
            <button type="submit" class="btn btn--primary" id="btn-login">Entrar</button>
        </form>
    </div>
    <script type="module" src="../assets/js/login.js"></script>
</body>

</html>