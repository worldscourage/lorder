# lorder
```cp .env.example .env```

```
docker-compose build && docker-compose up -d
docker exec lorderphp bash composer install
docker exec lorderphp bash php artisan migrate
```
