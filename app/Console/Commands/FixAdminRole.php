<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class FixAdminRole extends Command
{
    protected $signature = 'admin:fix-role {email}';
    protected $description = 'Verifica y corrige el rol de un usuario administrador';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Usuario con email {$email} no encontrado.");
            return 1;
        }

        $this->info("Usuario encontrado: {$user->name}");
        $this->info("Rol actual: {$user->role}");

        if ($user->role !== 'admin') {
            $user->role = 'admin';
            $user->save();
            $this->info("Rol actualizado a 'admin'.");
        } else {
            $this->info("El usuario ya tiene el rol de administrador.");
        }

        return 0;
    }
} 