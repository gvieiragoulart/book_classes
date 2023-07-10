Clone the project.
```bash
git clone https://github.com/gvieiragoulart/book_classes.git
```

Set up the .env variables.

Build the dockerfile and up the containers.

```bash
docker-compose up -d --build
```

The documentation will be on http://localhost:8000/docs/index.html

The project will need ports 8000,9000 and 3306

You will need to run the migratons and the composer install

```bash
docker-compose exec book_classes_app /bin/bash -c "composer install && php artisan migrate && php artisan key:generate"
```
