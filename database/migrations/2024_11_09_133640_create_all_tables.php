<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key', 255)->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key', 255)->primary();
            $table->string('owner', 255);
            $table->integer('expiration');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->boolean('is_admin')->default(false);
        });

        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->string('nama_produk', 100)->nullable();
            $table->string('merk', 100)->nullable();
            $table->string('jenis', 100)->nullable();
            $table->integer('harga')->nullable();
            $table->string('image', 225)->nullable();
            $table->unsignedBigInteger('no_comparison')->nullable();
            $table->timestamps();
        });

        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id_produk')->on('produk');
        });

        Schema::create('comparison', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_number', 255);
            $table->string('secondary_material', 255);
            $table->string('filling_material', 255);
            $table->string('maximum_load_capacity', 255);
            $table->string('width', 255);
            $table->string('height', 255);
            $table->string('domestic_warranty', 255);
            $table->timestamps();
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->increments('id_contact');
            $table->string('name', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('subject', 100)->nullable();
            $table->string('message', 1000)->nullable();
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue', 255);
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');

            $table->index('queue');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->string('name', 255);
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('id_cart');
            $table->unsignedInteger('id_produk')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('harga')->nullable();

            $table->foreign('id_produk')->references('id_produk')->on('produk');
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id_order');
            $table->date('tanggal_order')->nullable();
            $table->string('metode_pembayaran', 100)->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->string('alamat', 225)->nullable();
            $table->integer('jumlah_produk')->nullable();
            $table->text('status_order')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();
            $table->text('payment_proof')->nullable();

            $table->foreign('id_user')->references('id')->on('users'); 
        });

        Schema::create('order_produk', function (Blueprint $table) {
            $table->increments('id_order_produk');
            $table->unsignedInteger('id_order');
            $table->unsignedInteger('id_produk');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_order')->references('id_order')->on('order');
            $table->foreign('id_produk')->references('id_produk')->on('produk');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 255)->primary();
            $table->string('token', 255);
            $table->timestamp('created_at')->nullable();
        });

        

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity');

            $table->index('user_id');
            $table->index('last_activity');
        });

    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('produk');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('order_produk');
        Schema::dropIfExists('order');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('keranjang');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('contact');
        Schema::dropIfExists('comparison');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
    }
};
