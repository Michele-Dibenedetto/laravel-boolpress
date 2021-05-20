<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeyUserPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) //tabella di riferimento
        {
            $table->unsignedBigInteger('user_id'); //indica la colonna da creare

            $table->foreign('user_id') //indico quale colonna fara da collegamento tra le tabelle
                    ->references('id') //indico la colonna a cui mi sto aggrappando per creare il collegamento con l'altra tabella
                    ->on('users'); //indico la tabella con cui mi sto collegando
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign("posts_user_id_foreign");
            $table->dropColumn("user_id");
        });
    }
}
