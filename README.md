# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
2.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
3.  Utilize o comando `composer build` para fazer o deploy do banco de dados. **AVISO: O COMANDO VAI APAGAR O BANCO DE DADOS PRÉ-EXISTENTE CASO EXISTA**
    -   As credenciais de acesso do banco de dados podem ser alteradas em [database.json](config/database.json)
    -   Se [composer](https://getcomposer.org/) não estiver instalado, digite `bin/build.bat` para fazer o deploy
    -   Se preferir fazer o deploy manualmente, utilize [script.sql](database/script.sql)
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/
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

1.  [ ] (EDUARDO) Em session, logon.php faz um require diretamente em conexao.php e response.php. É ideal separar a interação com o banco de dados desse arquivo, criando uma API (funcionarios.php requirable) para fazer tal validação. Estrutura nova:
2.  [ ] (EDUARDO) Colocar um autoload.php em src, para adicionar mais lógica além de "check.php" no inicio de cada página. ex: revalidar root do projeto. Autoload terá apenas funções que cada app terá que chamar manualmente. Exemplo: função validateSession() para fazer o require do check.php e sair se for falso (para separar a lógica de redirect do check.php). Lembre-se de atualizar a estrutura de arquivos na seção DEV :\)
3.  [ ] (EDUARDO) Validação campos nulos (errors.php): a função deve receber assoc array de campos e throw error falando os que estão faltando
4.  [ ] (EDUARDO) Forma para encontrar raiz do projeto, para referenciar arquivos mais facilmente
    ```
    src/
        database/
            insert/
                funcionario.php
                fornecedor.php
                cliente.php
                categoria.php
                lancamento.php
            get/
                categorias.php    # Adicionar parametro opcional 'name' para $_GET
                funcionarios.php  # Parametro opcional 'email' para $_GET.
            conexao.php
        filesystem/
            getroot.php
        modules/
            sanitize.php
            errors.php
            utils.php
        session/
            logon.php
            check.php
            logoff.php
        view/
            categorias-select.php # require get/categorias.php e transformar em select
        autoload.php              # Método para chamar check.php, método para encontrar raiz do projeto
    ```

# Documentação (dev)

ESTRUTURA DE ARQUIVOS

```
project-root/
  .git/            # Git config
  assets/          # CSS, JavaScript, imagens, fonts
  build/           # Arquivos para deploy
  config/          # App config
  database/        # Arquivos de banco de dados
      php/
          deploy.php # Deploy do banco de dados utilizando PHP e Composer
      script.sql
      model.sql
  public/          # Páginas front-end
      index.php
      ...
  src/             # API banco de dados
      insert/...
      get/...
      modules/
          conexao.php
          erros.php
          sanitizar.php
          utils.php # String utils & Array utils
      session/...
      response.php # Garante resposta consistente da API
  templates/       # Arquivos padrões para paginas (navbar.php)
  vendor/          # Pacotes PHP
  .gitignore       # Arquivos ignorados pelo versionamento git
  composer.json    # Configurações de composer
```
