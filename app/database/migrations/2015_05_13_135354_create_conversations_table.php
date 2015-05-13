<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conversations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('swap_id');
            $table->string('subject');
            $table->timestamps();
        });

        Schema::table('messages', function(Blueprint $table)
        {
            $table->dropColumn('swap_id');
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

}
