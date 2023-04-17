<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersAddBroker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('broker')->nullable();
            $table->string('creci')->nullable();
            $table->string('commission')->nullable();
        });

        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // DB::table('roles')->insert([
        //     [
        //         'name' => 'Corretor',
        //         'guard_name' => 'web',
        //         'created_at' => new DateTime('now')
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['broker', 'creci', 'commission']);
        });
    }
}
