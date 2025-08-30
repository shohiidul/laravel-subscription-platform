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
        Schema::table('subscriptions', function (Blueprint $table) {

            // $table->dropUnique('subscriptions_email_unique');

            $table->unsignedBigInteger('portal_id')->after('id')->default(0);

            $table->foreign('portal_id')->references('id')->on('web_portals')->onDelete('cascade');

            $table->unique(['portal_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('portal_id');
            $table->unique('email');
        });
    }
};
