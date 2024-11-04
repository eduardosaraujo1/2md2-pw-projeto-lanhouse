# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Crie o Schema descrito em [script.sql](project-data/banco-de-dados/script.sql) em seu banco MySQL. As credenciais de acesso do banco podem ser visualizadas e alteradas através do arquivo [database.json](database.json)
2.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
3.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/www
6.  Para fazer login, o usuário administrador possui as seguintes credenciais:
    -   E-mail: admin@lanhouse.org
    -   Senha: admin01

# Sobre o Projeto

## Descrição

Trata-se de um sistema para uma Lan House fictícia onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

## Especificações

-   [Design Figma do projeto](https://www.figma.com/design/PGKnYiHtQ5wEX7GWklSsVg/Projeto-LanHouse?node-id=0-1&t=JGkDWUHh2upO3IXY-1)

# Roadmap

-   [ ] (EDUARDO) OPCIONAL - Implementar nixpacks no projeto para deploy em Railway
-   [ ] (EDUARDO) OPCIONAL - Estrutura de aquivos & comando `composer build`
    - https://stackoverflow.com/questions/31401495/directory-structure-for-a-php-website-using-composer-gulp-and-travis
    - https://docs.php.earth/faq/misc/structure/
    - ```
project-root/
  .git/            # Git configuration and source directory
  assets/          # CSS, JavaScript, images, fonts
  config/          # Application configuration
  database/        # MySQL .sql files
      php/
          deploy.php # Database deploy using composer build or build-global
      script.sql
      model.sql
  public/          # Website Root
      index.php    # Main entry point - front controller
      ...
  api/             # PHP API for database connection (main app)
      insert/...
      select/...
      modules/
          conexao.php
          erros.php
          sanitizar.php
          utils.php # String utils & Array utils
      response.php # Functions for consistent website response
  templates/       # Template files (navbar.php)
  vendor/          # 3rd party packages and components with Composer
  .gitignore       # Ignored files and dirs in Git (vendor...)
  composer.json    # Composer dependencies file
      ```
