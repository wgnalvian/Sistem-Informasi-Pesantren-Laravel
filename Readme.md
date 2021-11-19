<h1 align="center">Selamat datang di Sistem Informasi  Pesantren! 👋</h1>




## Install

1. **Clone Repository**

```bash
git clone https://github.com/wgnalvian/Sistem-Informasi-Pesantren-Laravel.git
cd Sistem-Informasi-Pesantren-Laravel
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate 
```

4. **Jalankan website**

```bash
php artisan serve
```




## License

- Copyright © 2020 Alvian
