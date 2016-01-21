<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update columns on user table
        Schema::table('users', function (Blueprint $table) {
            $table->string('role');
            $table->renameColumn('_id', 'northstar_id');
        });

        // Translate existing relations to plain column value
        $roleMapping = DB::table('roles')->join('role_user', 'role_user.role_id', '=', 'roles.id')->select('role_user.user_id', 'roles.name')->get();
        foreach ($roleMapping as $mapping) {
            $user = \Aurora\Models\User::find($mapping->user_id);
            $user->role = $mapping->name;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->renameColumn('northstar_id', '_id');
        });
    }
}
