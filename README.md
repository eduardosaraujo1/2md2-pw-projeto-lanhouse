# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Crie o Schema descrito em [script.sql](project-data/banco-de-dados/script.sql) em seu banco MySQL. As credenciais de acesso do banco podem ser visualizadas e alteradas através do arquivo [database.json](database.json)
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
-   [ ] (EDUARDO) #2 Implementar sistema login utilizando $SESSION
-   [ ] (EDUARDO) #3 Fazer botão de visualizar senha
-   [ ] (N/A) #4 A tela lancamentos.php não foi conectada ao banco pois:
    -   [ ] #4.1 O endpoint não está estruturado para exibir as categorias que estão no banco de dados no banco e retornar ao usuário esse script. (prestes a resolver)
    -   [ ] #4.2 O campo fk_id_funcionário obtem o usuário que está atualmente logado. Como não temos um sistema de login ainda, não é possível preencher esse campo. (prestes a resolver)

# Branch Roadmap

ARQUITETURA

```
LOGIN PAGE
On login button: logon.php ([Fetch with cookies](http://stackoverflow.com/questions/34558264/ddg#34592377))
-> Get user with submitted name and password
-> If exists then start session, save data, and return status sucess content ''
-> If not exists then return status error content 'credenciais invalidas'
If response is error, display error message (REQUIRES HTML AND CSS CHANGE).
If response is success, redirect to home
```
