# Тестовое задание на Lumen + Docker для Тикетона

Для проекта использовал вот этот шаблон для [Lumen + Docker](https://github.com/lephleg/laravel-lumen-docker)

Также для билда самого проекта добавил библиотеку GD для работы с
изображениями
```dockerfile
RUN apt-get install -y php7.4-gd
```

## Как поднять

```shell
git clone https://github.com/NurbekAbilev/ticketon
cd ticketon
docker-compose up -d
docker-compose exec app composer install
sudo chown -hR www-data:www-data src/storage/logs/
cp src/.env.example src/.env
```
