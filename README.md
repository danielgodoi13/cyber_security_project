## Passo a Passo para Configuração e Execução da Aplicação

### Pré-requisitos
Certifique-se de que os seguintes softwares estejam instalados no sistema antes de começar:

1. **PHP**: Versão 8.1 ou superior.
   - Baixe em [https://www.php.net/downloads](https://www.php.net/downloads).
   - Certifique-se de que as extensões necessárias (como `pdo_mysql`, `openssl`, `mbstring`, `tokenizer` e `json`) estejam habilitadas.
   - Adicione o diretório do PHP ao `PATH` nas Variáveis de Ambiente do Sistema para executar `php` no terminal.

2. **Composer**: Gerenciador de dependências para PHP.
   - Instale a versão mais recente em [https://getcomposer.org](https://getcomposer.org).

3. **MySQL**: Servidor de banco de dados.
   - Baixe em [https://dev.mysql.com/downloads/mysql/](https://dev.mysql.com/downloads/mysql/).
   - Adicione o diretório `bin` do MySQL ao `PATH` nas Variáveis de Ambiente do Sistema para executar `mysql` no terminal.

4. **Postman**: Ferramenta para testar APIs.
   - Baixe em [https://www.postman.com/downloads/](https://www.postman.com/downloads/).

5. **Git**: Sistema de controle de versões.
   - Instale em [https://git-scm.com/](https://git-scm.com/).

---

### Passo a Passo

1. **Fazer fork do projeto**
   - Acesse o repositório no GitHub: [https://github.com/danielgodoi13/cyber_security_project](https://github.com/danielgodoi13/cyber_security_project).
   - Clique em "Fork" no canto superior direito para criar uma cópia no seu GitHub.

2. **Clonar o repositório para sua máquina**
   - No terminal, execute:
     ```bash
     git clone https://github.com/<seu-usuario>/cyber_security_project.git
     ```
     Substitua `<seu-usuario>` pelo nome do seu usuário no GitHub.

   - Entre na pasta do projeto:
     ```bash
     cd cyber_security_project
     ```

3. **Configurar o arquivo `.env`**
   1. Renomeie o arquivo `.env.example` para `.env`:
      ```bash
      cp .env.example .env
      ```

   2. Edite o arquivo `.env` e configure as credenciais do banco de dados. Você deve definir:
      ```env
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=cyber_security_db
      DB_USERNAME=seu_usuario
      DB_PASSWORD=sua_senha
      ```
      - Substitua `seu_usuario` e `sua_senha` pelas credenciais configuradas no MySQL. Use um nome de banco significativo, como `cyber_security_db`.

4. **Instalar as dependências PHP**
   - No terminal, execute:
     ```bash
     composer install
     ```

5. **Criar o banco de dados no MySQL**
   1. Abra o terminal e execute:
      ```bash
      mysql -u root -p
      ```
      Insira a senha do usuário `root` (ou o usuário configurado no `.env`).

   2. No prompt do MySQL, execute:
      ```sql
      DROP DATABASE IF EXISTS cyber_security_db;
      CREATE DATABASE cyber_security_db;
      ```
      Substitua `cyber_security_db` pelo nome configurado no `.env`.

   3. Saia do MySQL:
      ```bash
      EXIT;
      ```

6. **Gerar a chave da aplicação**
   - No terminal, execute:
     ```bash
     php artisan key:generate
     ```

7. **Configurar o JWT (JSON Web Token)**
   - Gere a chave secreta para o JWT:
     ```bash
     php artisan jwt:secret
     ```
   - Este comando atualizará automaticamente o valor de `JWT_SECRET` no arquivo `.env`.

8. **Criar e configurar credenciais do Google OAuth 2.0**
   1. Acesse o console do Google Cloud: [https://console.cloud.google.com/](https://console.cloud.google.com/).

   2. Crie um novo projeto ou selecione um existente.

   3. Vá até "APIs e Serviços" > "Credenciais" e clique em "Criar credenciais".

   4. Escolha "ID do cliente OAuth" e configure o tipo de aplicativo como "Aplicativo da Web".

   5. Defina a URI de redirecionamento autorizada como:
      ```url
      http://localhost:8000/api/auth/google/callback
      ```

   6. Após criar as credenciais, copie o "Client ID" e o "Client Secret" gerados.

   7. Adicione as credenciais ao arquivo `.env`. Edite o arquivo para incluir:
      ```env
      GOOGLE_CLIENT_ID=sua_client_id
      GOOGLE_CLIENT_SECRET=sua_client_secret
      GOOGLE_REDIRECT_URI=http://localhost:8000/api/auth/google/callback
      ```

9. **Executar as migrações**
   - Rode as migrações para criar as tabelas no banco de dados:
     ```bash
     php artisan migrate
     ```

10. **Iniciar o servidor**
    - Execute o servidor Laravel:
      ```bash
      php artisan serve
      ```
    - A aplicação estará disponível em [http://localhost:8000](http://localhost:8000).

---

### Testar as Requisições

1. **Importar a coleção no Postman**
   - Abra o Postman e clique em "Import".
   - Escolha a opção "Link" e cole o link da coleção:
     ```
     https://equipe-trabalho-a13-cybersecurity.postman.co/workspace/A1%2F3-CyberSecurity~25b5dc18-eca0-4285-9c85-57914854e38b/collection/33239113-e8bf710f-80d8-434b-87ff-d6f46002b590?action=share&creator=33239113
     ```

2. **Executar as requisições**
   - As requisições já estão configuradas na coleção. Selecione a desejada e clique em "Send" para testar.

---
