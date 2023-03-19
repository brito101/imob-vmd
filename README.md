# Imob 2.0.0

## Commands
- cp .env.example .env
- composer install
- npm install && npm run dev
- php artisan storage:link
- php artisan key:generate
- php artisan jwt:secret
- php artisan migrate --seed

## Login 
- URI: /admin
- USER: user@imob.com
- PASS: password

## Commands production
- find imob-vmd -type d -exec chmod 0755 {} \;
- find imob-vmd -type f -exec chmod 0644 {} \;
- ln -s imob-vmd/public public_html
