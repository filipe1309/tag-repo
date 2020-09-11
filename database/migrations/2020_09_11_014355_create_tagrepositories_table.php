<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagrepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_repositories', function (Blueprint $table) {
            $table->bigIncrements('tag_repository_id');
            $table->foreignId('tag_id')->constrained();
            $table->foreignId('repository_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('tag_repository_type');
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
        Schema::dropIfExists('tag_repositories');
    }
}
