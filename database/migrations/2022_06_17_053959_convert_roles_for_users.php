<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable()->default(\App\Models\User::ROLE_USER)->after('password');
        });

        foreach (\App\Models\User::where('admin', true)->get() as $user) {
            $user->role = \App\Models\User::ROLE_ADMIN;
            $user->save();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};