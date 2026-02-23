<?php

namespace App\Actions;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

final class RegisterUserAction
{
    public function __invoke(array $data): User
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            Mail::to($user)->queue(new WelcomeEmail($user));

            return $user;
        } catch (\Throwable $e) {
            Log::error('Error registering user', [
                'email' => $data['email'] ?? 'unknown',
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
