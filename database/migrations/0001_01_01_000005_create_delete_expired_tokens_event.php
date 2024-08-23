<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Tạo sự kiện xóa token hết hạn
        DB::statement("
            CREATE EVENT IF NOT EXISTS delete_expired_tokens
            ON SCHEDULE EVERY 1 DAY
            DO
            DELETE FROM personal_access_tokens
            WHERE expires_at IS NOT NULL AND expires_at < NOW();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP EVENT IF EXISTS delete_expired_tokens");
    }
};
