<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@fastteknik.test',
            'password' =>  bcrypt('Emir1977'), // Şifreni değiştir!
            'is_admin' => true,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    
    public function down(): void
    {
        DB::table('users')->where('email', 'admin@fastteknik.test')->delete();
    }
};
