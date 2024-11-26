Passo a Passo para Configuração e Execução da aplicação

Pré-requisitos
Certifique-se de que os seguintes softwares estejam instalados no sistema antes de começar:

1. PHP: Versão 8.1 ou superior.
   - Instale em https://www.php.net/downloads.
   - Certifique-se de que as extensões necessárias (como `pdo_mysql`, `openssl`, `mbstring`, `tokenizer`, e `json`) estão habilitadas.
   - Adicione o diretório do PHP ao PATH nas Variáveis de Ambiente do Sistema para executar `php` no terminal.

2. Composer: Versão mais recente.
   - Instale em https://getcomposer.org.

3. MySQL: Servidor de banco de dados.
   - Instale em https://dev.mysql.com/downloads/mysql/.
   - Adicione o diretório `bin` do MySQL ao PATH nas Variáveis de Ambiente do Sistema para executar `mysql` no terminal.

4. Postman: Ferramenta para testar APIs.
   - Baixe em https://www.postman.com/downloads/.

5. Git: Para clonar o repositório.
   - Instale em https://git-scm.com/.

Passo a Passo

1. Fazer fork do projeto
   - Acesse o repositório no GitHub: https://github.com/danielgodoi13/cyber_security_project.
   - Clique em "Fork" no canto superior direito para criar uma cópia no seu GitHub.

2. Clonar o repositório para sua máquina
   - No terminal, execute:
     ```bash
     git clone https://github.com/<seu-usuario>/cyber_security_project.git
     ```
   - Substitua `<seu-usuario>` pelo nome do seu usuário no GitHub.
   - Entre na pasta do projeto:
     ```bash
     cd cyber_security_project
     ```

3. Configurar o arquivo .env
   - Renomeie o arquivo `.env.example` para `.env`:
     ```bash
     cp .env.example .env
     ```
   - Edite o arquivo `.env` e configure as credenciais do banco de dados. Você deve definir:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=cyber_security_db
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```
     - Substitua `seu_usuario` e `sua_senha` pelas credenciais configuradas no MySQL. Certifique-se de usar um nome de banco significativo, como `cyber_security_db`.

4. Instalar as dependências PHP
   - No terminal, execute:
     ```bash
     composer install
     ```

5. Criar o banco de dados no MySQL
   Após configurar o `.env` e instalar as dependências, crie o banco de dados usando MySQL no terminal:
   
   1. Abra o terminal e execute:
      ```bash
      mysql -u root -p
      ```
      Insira a senha do usuário `root` (ou o usuário configurado no `.env`).

   2. No prompt do MySQL, execute os seguintes comandos:
      ```sql
      DROP DATABASE IF EXISTS cyber_security_db;
      CREATE DATABASE cyber_security_db;
      ```
      Substitua `cyber_security_db` pelo nome configurado no `.env`.

   3. Saia do MySQL:
      ```bash
      EXIT;
      ```

6. Gerar a chave da aplicação
   - No terminal, execute:
     ```bash
     php artisan key:generate
     ```

7. Configurar o JWT
   - Gere a chave secreta para o JWT:
     ```bash
     php artisan jwt:secret
     ```
   - Este comando atualizará automaticamente o valor de `JWT_SECRET` no arquivo `.env`.

8. Executar as migrações
   - Rode as migrações para criar as tabelas no banco de dados:
     ```bash
     php artisan migrate
     ```

9. Iniciar o servidor
   - Execute o servidor Laravel:
     ```bash
     php artisan serve
     ```
   - A aplicação estará disponível em http://localhost:8000.

10. Testar as requisições com Postman
   Para testar as APIs da aplicação:

   1. Importe a coleção compartilhada:
      - Abra o Postman e clique em "Import".
      - Escolha a opção "Link" e cole o link da coleção:
        ```
        https://equipe-trabalho-a13-cybersecurity.postman.co/workspace/A1%2F3-CyberSecurity~25b5dc18-eca0-4285-9c85-57914854e38b/collection/33239113-e8bf710f-80d8-434b-87ff-d6f46002b590?action=share&creator=33239113
        ```
      - Clique em "Import".

   2. Execute as requisições:
      - As requisições já estão configuradas na coleção. Basta selecionar a desejada e clicar em "Send" para testar.
