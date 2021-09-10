<?php

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Discussion::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('reaction', ['like', 'dislike', 'upvote', 'downvote']);
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
        Schema::dropIfExists('discussion_reactions');
    }
}
