<?php

use App\Models\User;
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
        Schema::create('weather_datas', function (Blueprint $table) {
            $table->id();
            $table->decimal('precipitation', total:4, places: 1)->nullable();
            $table->decimal('sunshine', total:4, places: 1)->nullable();
            $table->decimal('snow', total:4, places: 1)->nullable();
            $table->decimal('temperature', total:4, places: 1)->nullable();
            $table->decimal('humidity', total:4, places: 1)->nullable();
            $table->decimal('wind', total:4, places: 1)->nullable();
            $table->timestamp('imported_at');
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weather_datas', function (Blueprint $table){
            $table->dropForeignIdFor(User::class);
        });
        Schema::dropIfExists('weather_datas');
    }
};
