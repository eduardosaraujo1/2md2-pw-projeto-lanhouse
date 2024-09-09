# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Sobre o Projeto

-   Sistema para uma LanHouse
-   Para encontrar o Banco de Dados, Logos e outros dados do projeto, acesse a pasta `ABOUT`

# Roadmap

-   Adicionar validação de campos para cada formulário (filtros de teclas permitidas, adicionar campos `required`, etc)
    -   Falta validação de tamanho de cada campo
    -   **Falta validação de Telefone de fornecedor**
-   Tentar remover ao máximo a repetição de código em todas as variações de insert_table, utilizando funções
    -   Se possível de qualquer forma, fazer um método com todos os inserts necessários
-   Exibir para o usuário o sucesso ou falha dos cadastros.
    -   Fazer mensagem de erro ou sucesso abaixo do título.
    -   Se for bem sucedido, falar que deu bom e redirecionar para a tela principal alguns segundos depois
    -   Se ocorrer um erro, exibir que ocorreu um erro
-   Fazer a tela de insert_lancamento não foi possível pois requer os seguintes parametros:
    -   Exibir as categorias que estão no banco de dados no campo "categoria"
    -   Validação de funcionário atual para preencher o campo fk_id_funcionário
-   BCrypt ou Argon2 para proteção de senhas
