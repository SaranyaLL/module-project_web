<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // references users table
            $table->string('payment_id')->unique(); // unique payment ID
            $table->decimal('amount', 10, 2); // amount field with precision
            $table->string('status'); // status field for order status
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
