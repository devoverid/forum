<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Discussion;
use App\Models\Tag;

class CreateDiscussionTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Discussion::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Tag::class)->constrained()->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('discussion_tag');
    }
}
