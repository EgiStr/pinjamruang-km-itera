<?php

use App\Enums\ApprovalStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_rooms', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('borrower_id');

            $table->foreignId('room_id')->constrained();
            $table->dateTime('borrow_at');
            $table->dateTime('until_at');
            $table->unsignedInteger('admin_id')->nullable();
            $table->tinyInteger('admin_approval_status')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // upload file surat_peminjaman
            $table->string('surat_peminjaman')->nullable();

            $table->dateTime('finished_at')->nullable();

            $table->foreign('borrower_id')
                ->references('id')->on('admin_users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrow_rooms');
    }
}
