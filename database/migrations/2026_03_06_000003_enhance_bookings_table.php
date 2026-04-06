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
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'confirmation_code')) {
                $table->string('confirmation_code')->unique()->nullable()->after('status');
            }
            if (!Schema::hasColumn('bookings', 'payment_id')) {
                $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null');
            }
            if (!Schema::hasColumn('bookings', 'notes')) {
                $table->text('notes')->nullable()->after('special_requests');
            }
            if (!Schema::hasColumn('bookings', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
            $table->dropColumn(['confirmation_code', 'payment_id', 'notes']);
            $table->dropSoftDeletes();
        });
    }
};
