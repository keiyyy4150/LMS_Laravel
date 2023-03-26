<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question_number', '14')->unique();
            $table->integer('questioners_id');
            $table->string('subject', '255');
            $table->string('category', '255');
            $table->string('title','255');
            $table->string('question', '2000');
            $table->mediumText('reference_matter')->nullable();
            $table->tinyInteger('status')->default(0); // 0:未解決 1:解決 2:凍結 3:回答期限切れ
            $table->dateTime('answer_deadline');
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
        Schema::dropIfExists('questions');
    }
}
