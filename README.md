
# Devover Forum

![Login Page](https://github.com/devoverid/forum/blob/master/public/assets/images/ss3.png?raw=true)


[![](https://img.shields.io/github/issues/devoverid/forum?style=flat-square)](https://img.shields.io/github/issues/devoverid/forum?style=flat-square) ![](https://img.shields.io/github/stars/devoverid/forum?style=flat-square)
![](https://img.shields.io/github/forks/devoverid/forum?style=flat-square)  [![HitCount](http://hits.dwyl.com/devoverid/https://github.com/devoverid/forum.svg)](http://hits.dwyl.com/devoverid/https://github.com/devoverid/forum)  [](http://makeapullrequest.com) [![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg?style=flat-square)](https://GitHub.com/Naereen/StrapDown.js/graphs/commit-activity) [![made-for-VSCode](https://img.shields.io/badge/Made%20for-VSCode-1f425f.svg?style=flat-square)](https://code.visualstudio.com/) [![GitHub followers](https://img.shields.io/github/followers/viandwi24.svg?style=flat-square&label=Follow&maxAge=2592000)](https://github.com/viandwi24?tab=followers)

### What is devover forum  ?
a Forum Website based Laravel with TailwindCss, created by <a href="https://github.com/viandwi24"> Alfian Dwi </a>.

### Features
- Standart Auth (Login, Register, Activate Account by Email, Forgot Password)
- Github Account
- Discussion (Create, Comments)
- Disucssion and Comment Editor with Markdown Format
- Profile
- Etc.

### To-do List
- [x] Discussion & Comments
- [x] Delete Discussion Comments
- [x] Discussion Edit & Delete
- [x] Discussion Set Solved
- [x] Owner Pages
- [x] Profile Setting
- [x] Login & Register with Github
- [x] Email Verification
- [x] Forgot Password
- [x] Login & Register with Facebook
- [x] Minify Page
- [x] Migrate to scss
- [ ] Re-design Homepage
- [ ] Re-design Component
- [x] Completing Owners Pages
- [ ] Error Page
- [x] Set / Unset Best Answer Discussion
- [ ] Re-design Discussion Comment
- [ ] Re-design Discussion Create Page


## Install

1. **Clone Repository**
```
git clone https://github.com/devoverid/forum
cd forum
composer install
copy .env.example .env

# for dev :
npm install && npm run dev
```

2. **Open ```.env``` and change configuration database**
```
// database configuration
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

// email configuration - verify user register
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

// github client oauth
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_CLIENT_URI=

// facebook client oauth
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_CLIENT_URI=
```
*note : for facebook callback, must be https

3. **Prepare a website**
```bash
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed --class=TagSeeder 
```

4.**Run A Web**
```bash
php artisan serve
```

## Author
- Facebook : <a href="https://www.facebook.com/viandwi24"> Alfian Dwi Nugraha</a>

## Thanks For
- Allah SWT
- <a href="devover.id">Devover</a>
- <a href="github.com/zuramai">Ahmad Saugi</a>
- Everyone whosupports me 

## Contributing
Contributions, issues and feature requests you can do..


## License
- Copyright © 2020 Alfian Dwi Nugraha.
- **Devover Forum is open-sourced software licensed under the MIT license.**

------------
- **Made with ❤️ by Alfian Dwi Nugraha .**
- Thanks to <a href="http://devover.id">DevoverID</a>
- **Devover Forum** is open-sourced software licensed under the MIT license.
