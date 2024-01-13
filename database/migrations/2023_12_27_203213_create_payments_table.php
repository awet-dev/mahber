<?php

use App\Enum\PaymentCategoryEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('amount_paid', 9,2);
            $table->double('amount_left', 9,2)->nullable();
            $table->double('amount_back', 9,2)->nullable();
            $table->foreignUuid('user_id')->constrained();
            $table->enum('category', PaymentCategoryEnum::toArray());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
