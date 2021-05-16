## Development Guide
This project support docker with laravel sail.

1. **Clone Repository**

```bash
git clone https://github.com/devoverid/forum
cd forum
composer install
npm install
copy .env.example .env

# or `yarn && yarn dev`
npm install && npm run dev
```

2. **Open `.env` and change configuration database**

```env
# database configuration
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# email configuration - verify user register
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

# github client oauth
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_CLIENT_URI=

# facebook client oauth
# facebook callback require SSL protocol.
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_CLIENT_URI=
```

3. **Prepare a website**

```bash
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
```

4. **Run A Web**

```bash
php artisan serve
```