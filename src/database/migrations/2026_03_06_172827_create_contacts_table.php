<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
        // 外部キー（Categoryテーブルとの紐付け）
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender')->comment('1:男性, 2:女性, 3:その他');
            $table->string('email');
            $table->string('tel'); // phone1,2,3を合体させる場合はここ
            $table->string('address');
            $table->string('building')->nullable(); // 建物名は空でもOKにする
            $table->text('detail'); // お問い合わせ内容
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
        Schema::dropIfExists('contacts');
    }
}
