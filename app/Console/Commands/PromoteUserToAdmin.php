<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PromoteUserToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:promote {phone : The user\'s phone number} {--role=admin : admin or staff}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant an existing user the admin or staff role so they can log into the web dashboard';

    public function handle(): int
    {
        $role = $this->option('role');

        if (! in_array($role, ['admin', 'staff'])) {
            $this->error('Role must be either "admin" or "staff".');

            return self::FAILURE;
        }

        $user = User::where('phone', $this->argument('phone'))->first();

        if (! $user) {
            $this->error('No user found with that phone number.');

            return self::FAILURE;
        }

        $user->update(['role' => $role]);

        $this->info("{$user->username} ({$user->phone}) is now '{$role}'.");

        return self::SUCCESS;
    }
}
