<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentativeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentative_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tentative_question_number', '14');
            $table->integer('questioners_id');
            $table->string('subject', '255');
            $table->string('category', '255');
            $table->string('title', '255');
            $table->string('question', '2000');
            $table->mediumText('reference_matter')->nullable();
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
        Schema::dropIfExists('tentative_questions');
    }
}
