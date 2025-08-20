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
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_topik');
            $table->string('nama_dataset');
            $table->json('meta_data_json')->nullable();
            $table->text('metadata_info')->nullable();
            $table->string('files')->nullable();
            $table->timestamp('last_update')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();

            $table->foreign('id_topik')
                ->references('id_topik')
                ->on('topiks')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};
