# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
2.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
3.  Caso tenha [composer](https://getcomposer.org/) instalado, utilize o comando `composer build` para fazer o deploy do banco de dados
    -   Se preferir por um deploy manual, utilize o arquivo [script.sql](database/script.sql)
    -   No caso de um erro no comando build, tente o alternativo `composer build-global`.
    -   Para alterar os parametros do banco de dados, veja o arquivo [database.json](./config/database.json);
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/www
6.  Para fazer login, o usuário administrador possui as seguintes credenciais:
    -   E-mail: admin@lanhouse.org
    -   Senha: admin01

# Sobre o Projeto

## Descrição

Trata-se de um sistema para uma Lan House fictícia onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

## Referências

-   [Design Figma do projeto](https://www.figma.com/design/PGKnYiHtQ5wEX7GWklSsVg/Projeto-LanHouse?node-id=0-1&t=JGkDWUHh2upO3IXY-1)
-   [Canva da Logo](https://www.canva.com/design/DAGL5--3MWw/aEQKmSfDH_Kinom0rT7OPQ/edit)

# Roadmap

-   [x] (EDUARDO) OPCIONAL - Implementar nixpacks no projeto para deploy em Railway
-   [x] (EDUARDO) OPCIONAL - Estrutura de aquivos & comando `composer build`
    -   https://stackoverflow.com/questions/31401495/directory-structure-for-a-php-website-using-composer-gulp-and-travis
    -   https://docs.php.earth/faq/misc/structure/

# Documentação (dev)

ESTRUTURA DE ARQUIVOS

```
project-root/
  .git/            # Git config
  assets/          # CSS, JavaScript, imagens, fonts
  config/          # App config
  database/        # Arquivos de banco de dados
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
