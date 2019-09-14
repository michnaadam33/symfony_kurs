# Kurs symfony
## 9 Doctrine

### Dodawanie doctrine

### Instalacja doctrine
```bash
composer require symfony/orm-pack
```
### Tworzenie bazy danych
```bash
php bin/console doctrine:database:create
```

### Update schematu bazy dancyh
```bash
 ./bin/console doctrine:schema:update --dump-sql
 ./bin/console doctrine:schema:update --force
```