<?php

use App\Models\Order;
use App\Models\Product;
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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->references('id')->on('orders');
            $table->foreignIdFor(Product::class)->references('id')->on('products');
            $table->string('qty');
            $table->tinyInteger('status')->default(Order::NOT_PAID);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
