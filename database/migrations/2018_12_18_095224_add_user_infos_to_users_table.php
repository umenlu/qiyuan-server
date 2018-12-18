<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInfosToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company')->nullable()->unique()->after('email');
            $table->string('address')->nullable()->after('company');
            $table->string('market')->nullable()->after('address');
            $table->string('vip_account')->nullable();
            $table->string('vip_url')->nullable();
            $table->date('vip_enddate')->nullable();
            $table->string('vip_belong')->nullable();
            $table->string('vip_type')->nullable();
            $table->boolean('vip_bao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company');
            $table->dropColumn('address');
            $table->dropColumn('market');
            $table->dropColumn('vip_account');
            $table->dropColumn('vip_url');
            $table->dropColumn('vip_enddate');
            $table->dropColumn('vip_belong');
            $table->dropColumn('vip_type');
            $table->dropColumn('vip_bao');
        });
    }
}
