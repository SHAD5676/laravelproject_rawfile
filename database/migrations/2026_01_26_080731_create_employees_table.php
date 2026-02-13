<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('password');
            $table->timestamps();
        });

        // Create employee user
        DB::table('employees')->insert([
            'name' => 'John Employee',
            'email' => 'employee@example.com',
            'phone' => '123-456-7890',
            'designation' => 'Software Developer',
            'department' => 'IT',
            'password' => Hash::make('Admin1205'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
