<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('ship_id')->index()->nullable()->default(null)->after('id');
            $table->unsignedBigInteger('rank_id')->index()->nullable()->default(null)->after('ship_id');
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('set null');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('set null');
        });
        
        Schema::create('notification_rank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_id')->index();
            $table->unsignedBigInteger('rank_id')->index();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ship_id');
            $table->dropColumn('rank_id');
            $table->dropForeign('ship_id');
            $table->dropForeign('rank_id');
        });

        Schema::dropIfExists('notification_rank');
    }
}
