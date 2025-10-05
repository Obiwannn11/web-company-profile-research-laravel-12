<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publication_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pub_category_trans')->constrained('publication_categories')->onDelete('cascade'); // publication_category_id
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['pub_category_trans', 'locale'], 'pub_category_locale_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_category_translations');
    }
};
