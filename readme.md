# nettecamp-doctrine-model-workshop

Requirement: PHP 7

* `composer install`
* prepare db
* create `app/config/config.local.neon`

```yaml
doctrine:
    user: root
    password: heslo
    dbname: nettecamp_workshop_doctrine
```

* `php bin/console.php orm:sch:up --force` (nepřepište si db :P)

## Requests

### `POST /v1/salesman/create`

Vytvoří obchodníka

```json
{
    "name": "Filip",
    "registrationId": "12345"
}
```


### `GET /v1/salesman/read/:salesmanId`

Vrátí obchodníka

```json
{
  "id": "0820a56a-3d67-4669-91eb-1df6078dc495",
  "name": "Filip",
  "registrationId": "12345"
}
```
