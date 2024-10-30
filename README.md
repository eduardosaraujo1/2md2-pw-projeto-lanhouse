# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Crie o Schema descrito em [script.sql](project-data/banco-de-dados/script.sql) em seu DBMS. Certifique-se que o banco é acessado utilizando os seguintes parametros:
    -   `Host: localhost`
    -   `Port: 3306`
    -   `User: root`
    -   `Password: root`
    -   Note: Enquanto o Roadmap #8 não for resolvido, edite a query string que se encontra no arquivo [init.php](www/database/init.php)
2.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
3.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/www

# Sobre o Projeto

## Descrição

Trata-se de um sistema para uma Lan House fictícia onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

## Especificações

-   [Design Figma do projeto](https://www.figma.com/design/PGKnYiHtQ5wEX7GWklSsVg/Projeto-LanHouse?node-id=0-1&t=JGkDWUHh2upO3IXY-1)

# Roadmap

-   [ ] (GIAN) #1 Fazer uma tela de home.php melhorada
-   [ ] (EDUARDO) #2 Refatore o CSS do projeto seguindo o projeto Figma e a nova Navbar. O plano de reescrever o CSS do zero foi alterado para corrigir o CSS atual.
    -   Editar o CSS para as especificações se encaixarem às do figma.
    -   Alterar o HTML para que ele invoque o CSS corretamente (os passos acima e esse feitos simultaneamente)
-   [ ] (EDUARDO) #3 Implemente as melhorias de navbar (dropdown e user control)
-   [x] (EDUARDO) #4 No arquivo Figma, altere os frames para 1200x675 com containers de 1140px (Tela XL do bootstrap)
-   [ ] (EDUARDO) #5 Utilizar [ES6 Modules](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules) para separar funcionalidades como validação de formulario. (Isso deve corrigir o problema de que o salario não está suportando casas decimais)
-   [ ] (EDUARDO) #6 A string de conexão atualmente é hardcoded no sistema (em init.php), por isso o banco de dados precisa ser local estar na porta 3306 e possuir usuario e senha root. Faça um arquivo settings.json e deixe esses parametros mais facil de alterar
-   [ ] (N/A) #8 A tela lancamentos.php não foi conectada ao banco pois:

    -   #7.1 O banco não está estruturado para exibir as categorias que estão no banco de dados no banco e retornar ao usuário esse script.
    -   #7.2 O campo fk_id_funcionário obtem o usuário que está atualmente logado. Como não temos um sistema de login ainda, não é possível preencher esse campo.
