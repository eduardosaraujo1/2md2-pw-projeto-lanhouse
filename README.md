# Como utilizar

1.  Execute o script [project-data/banco-de-dados/script.sql] em um servidor MySQL
    -   O usuário do servidor deve ser 'root' e a senha deve ser 'root', para alterar, modifique [init.php](www/endpoint/init.php)
2.  Com o banco de dados criado, copie o conteúdo para a raiz de seu servidor Apache (para XAMPP, C:\\xampp\\htdocs)
    1. Alternativamente, clone o repotisótio utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`

Note: Utilizando a solução alternativa, é recomendado redefinir `DocumentRoot` da configuração do seu servidor (C:\xampp\apache\conf\httpd.conf) para a pasta www, para que não seja necessário navegar até o website manualmente. Caso não tenha alterado o caminho do xampp e clonado utilizando o nome do repositório, é possível seguir o exemplo abaixo:

```
DocumentRoot "C:/xampp/htdocs/2md2-pw-projeto-api/www"
<Directory "C:/xampp/htdocs/2md2-pw-projeto-api/www">
    ...
</Directory>
```

# Sobre o Projeto

Sistema para uma Lan House onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja

# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Roadmap

-   Figma: Reduzir tamanho das telas para que os tamanhos das fontes correspondam (no momento, 24px no figma correspondem a 16px no html)
-   Fazer a tela de lancamento.php não foi possível pois requer os seguintes parametros:
    -   Exibir as categorias que estão no banco de dados no campo "categoria"
    -   Validação de funcionário atual que está cadastrando para preencher o campo fk_id_funcionário
-   ~~Tentar aplicar MVC (Model View Controller) ao projeto~~ (Fica dificil para colegas de equipe entenderem MVC)
