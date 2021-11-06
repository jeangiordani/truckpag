# Instruções para executar

Foi usado Laravel e MySQL nesse projeto, junto com testes usando PHPUnit.

* Primeiro é preciso criar um arquivo .env e copiar o conteúdo do .env.example para .env, dependendo do terminal você pode executar o comando abaixo:
```sh
$ cp .env.example .env
```
* É necessário configurar o arquivo .env com as configurações do banco de dados.
Exemplo
```sh
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=truckpag
DB_USERNAME=root
DB_PASSWORD=
```
Mude essas configurações de acordo com as credenciais.
* Depois crie o banco de dados com o mesmo nome do DB_DATABASE do do arquivo .env.

* Depois instalar as dependencias com o comando abaixo:

```sh
$ composer install
```
* É necessário gerar a key do projeto com o comando.

```sh
$ php artisan key:generate
```
* Depois migre o banco de dados
```sh
$ php artisan migrate
```
# Instruções para executar os testes

* Migrar os testes para o banco de dados externo, nesse caso é o SQLite.

```sh
$ php artisan migrate --database sqlite_testing
```
* Para executar os testes é só rodar o comando.

```sh
$ php artisan test
```
## De acordo com os comando testados na minha máquina, é pro pejeto estar funcionando direito.

# Endpoints

| Endpoint                             | Retorno                                                                 | Parâmetros do body                  |
|--------------------------------------|-------------------------------------------------------------------------|-------------------------------------|
| GET /cities/{sigla} exemplo "RS"     | Retorna todas as cidades do estado de acordo com a sigla e guarda no DB |                                     |
| GET /address                         | Retorna todos os endereços criados                                      |                                     |
| GET /address/{id}                    | Retorna somente um endereço de acordo com o id                          |                                     |
| POST /address                        | Cria um endereço                                                        | logradouro, numero, bairro, city_id |
| PUT /address/{id}                    | Atualiza um endereço                                                    | logradouro, numero, bairro, city_id |
| DELETE /address/{id}                 | Exclui um endereço                                                      |                                     |

