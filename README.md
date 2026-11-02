# Автошкола Мартин — Laravel

This folder is a **standalone Laravel 13** rebuild of the static Avtoskola Martin website. The original HTML/PHP site next to this folder is unchanged.

## Run locally

```bash
cd laravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Open http://127.0.0.1:8000

## Environment

Set in `.env`:

- `OPENAI_API_KEY` — chatbot
- `MAIL_TO` — contact and registration inbox (default `avtoskolamartin@hotmail.com`)
- `MAIL_MAILER=smtp` plus host/username/password on the live server (local default is `log`)

## Chatbot

`POST /api/chat` — same conversation, retrieval, and lead capture as before. Leads are stored in the `leads` table and `storage/app/chat/leads.log`.

## Deploy on avtoskolamartin.mk

Point the domain document root to `laravel/public`, PHP 8.3+, Composer, writable `storage/` and `bootstrap/cache/`. Configure SMTP so Hotmail receives form mail.
