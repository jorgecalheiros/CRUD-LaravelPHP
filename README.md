
<img src = "https://www.tvplayer.com.br/img/Gerenciador-de-Conteudo-Web-Apresentacao.png">

# Mini gerenciador de conteudos com Laravel

Essa aplicação tem como objetivo criar um gerenciador de conteudos que foi construida com as seguintes tecnologias:

- Laravel 8
- Docker
- Xampp

---

## Instalação com Xampp

### Requisitos

- Composer
- Xampp
- Node.JS

### Passos necessários:

- Colar o repositorio dentro da pasta htdocs do xampp

- Copiar o arquivo .env.example e mudar o nome para .env **(Ambiente de prodrução)**

- Executar o comando `composer update`

- Executar o camando `npm install`

- Executar o comando `npm run watch` **(Ambiente de desenvolvimento)**

---
## Observações

Após os passos anteriores é necessário inserir algumas informações importante dentro do arquivo `.env`


|Váriavel  |Valor  |
|---------|---------|
|APP_URL     |Insira url da aplicação )      |
|APP_KEY     |Execute o comando `php artisan key:generate`         |
|DB_CONNECTION     |mysql         |
|DB_DATABASE     |defina o nome desejado para a base de daddos         |
|DB_PASSWORD     |defina a senha desejada para a base de dados         |

---
## Banco de dados

Depois de fazer as observações crie o banco de dados de acordo com as intruções

- No phpmyadim ou no mysql crie um banco de dados com o nome do DB_DATABASE do arquivo `.env`
- Agora no editor de codigo dentro do terminal execute o comando `php artisan migrate`
- E execute o comando `php artisan db:seed` para criar 10 registros do banco de dados **(Opcional)**
- Pronto sua aplicação está funcionando

---
## Em desenvolvimento


