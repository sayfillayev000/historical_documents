Bu project tarixiy hujjatlarga kamentariya yozadigan web dastur

repository ni clone qilib olish

```bash
   git clone https://github.com/sayfillayev000/historical_documents.git
   cd historical_documents
```

```bash
   composer install
   npm install
```

```bash
npm run build || npm run dev
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
touch database/database.sqlite

php artisan migrate --seed
```

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

```bash
php artisan serve
```

Admin
email => admin@example.com,
password =>password,

User
email => john@example.com,
password => password,
