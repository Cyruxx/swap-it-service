<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::dropIfExists('comments');
        Schema::create('offers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('swap_id');
            $table->string('image');
            $table->text('comment');
            $table->boolean('accepted')->default(false);
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
		//
	}

}
