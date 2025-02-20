# API Laravel - Minha Agenda

Este é um projeto de API desenvolvida em Laravel, utilizando PostgreSQL e Docker. A API implementa autenticação de usuários, CRUD de eventos e CRUD de usuários seguindo os princípios de SOLID.

## Requisitos

Para rodar este projeto localmente, certifique-se de ter o PHP, Composer e Laravel instalados na sua máquina.

## Instalação

Após clonar este repositório, navegue até o diretório do projeto e execute os seguintes comandos:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan passport:keys
```

Configure o banco de dados no arquivo `.env` e rode as migrations:

```bash
php artisan migrate
```

Configure agora a rota publica para o servidor de arquivos

```bash
php artisan storage:link
```

## Executando o Projeto

Para iniciar o servidor de desenvolvimento, utilize o seguinte comando:

```bash
php artisan serve
```

Caso esteja usando docker:

```bash
docker-compose up -d
```

Isso iniciará a API Laravel, que poderá ser acessada através de `http://localhost:8000`.

## Autenticação

A API possui sistema de autenticação com login, registro e logout.

- **Registro**

  ```http
  POST /api/register
  ```

- **Login**

  ```http
  POST /api/login
  ```

- **Logout**

  ```http
  POST /api/logout
  ```

## CRUD de Eventos

- **Listar eventos**

  ```http
  GET /api/events
  ```

- **Criar evento**

  ```http
  POST /api/events
  ```

- **Visualizar evento**

  ```http
  GET /api/events/{id}
  ```

- **Atualizar evento**

  ```http
  PUT /api/events/{id}
  ```

- **Excluir evento**

  ```http
  DELETE /api/events/{id}
  ```

## CRUD de Usuários

- **Listar usuários**

  ```http
  GET /api/users
  ```

- **Criar usuário**

  ```http
  POST /api/users
  ```

- **Visualizar usuário**

  ```http
  GET /api/users/{id}
  ```

- **Atualizar usuário**

  ```http
  PUT /api/users/{id}
  ```

- **Excluir usuário**

  ```http
  DELETE /api/users/{id}
  ```

## Documentação

A documentação completa está disponível em uma Collection do Postman disponível
[clicando aqui](https://documenter.getpostman.com/view/29692695/2sAYdbMsPo)

## Tecnologias Utilizadas

- Laravel v11
- PostgreSQL
- Docker (*)
- Composer
- PHP v8
