<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaratrustSetupTables extends Migration
{
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::create('role_admin', function (Blueprint $table) {
            $table->uuid('role_id');
            $table->uuid('admin_id');
            $table->string('user_type');

            // $table->foreignUuid('role_id')->references('id')->on('roles')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_admin', function (Blueprint $table) {
            $table->uuid('permission_id');
            $table->uuid('admin_id');
            $table->string('user_type');

            // $table->foreignUuid('permission_id')->references('id')->on('permissions')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_id', 'permission_id', 'user_type']);
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            // $table->uuid('permission_id');
            // $table->uuid('role_id');

            $table->foreignUuid('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_admin');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_admin');
        Schema::dropIfExists('roles');
    }
}
