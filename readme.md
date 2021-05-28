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
docker-compose exec app php artisan migrate
```
Дальше заходим на http://localhost/

![test-image](https://user-images.githubusercontent.com/38177308/120010836-6eb73c00-bfff-11eb-95d6-b502ad0c62a5.jpg)

![test-image2](https://user-images.githubusercontent.com/38177308/120011054-b1791400-bfff-11eb-8199-e34a4f8210e4.jpg)
