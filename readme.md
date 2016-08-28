nettecamp-doctrine-model-workshop
=================

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
