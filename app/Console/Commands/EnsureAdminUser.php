<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class EnsureAdminUser extends Command
{
    protected $signature = 'admin:ensure {--reset : Replace the password from ADMIN_PASSWORD}';

    protected $description = 'Create the staff login used to read chatbot conversations';

    public function handle(): int
    {
        $email = (string) config('admin.email');
        $password = (string) config('admin.password');
        $name = (string) config('admin.name', 'Администратор');

        if ($email === '' || $password === '') {
            $this->error('Set ADMIN_EMAIL and ADMIN_PASSWORD in the environment.');

            return self::FAILURE;
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('ADMIN_EMAIL is not a valid email address.');

            return self::FAILURE;
        }

        if (strlen($password) < 12) {
            $this->error('ADMIN_PASSWORD must be at least 12 characters.');

            return self::FAILURE;
        }

        $existing = User::query()->where('email', $email)->first();
        if ($existing !== null && ! $this->option('reset')) {
            $this->info('Admin user already exists: '.$email);

            return self::SUCCESS;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name !== '' ? $name : 'Администратор',
                'password' => $password,
                'email_verified_at' => now(),
            ],
        );

        $this->info('Admin user is ready: '.$email);

        return self::SUCCESS;
    }
}
