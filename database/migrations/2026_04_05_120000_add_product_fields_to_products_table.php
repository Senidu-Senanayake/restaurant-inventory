<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds columns when the original create_products migration already ran with an empty schema.
     */
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'name')) {
                $table->string('name')->default('');
            }
            if (! Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable();
            }
            if (! Schema::hasColumn('products', 'price')) {
                $table->decimal('price', 10, 2)->default(0);
            }
            if (! Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        Schema::table('products', function (Blueprint $table) {
            $columns = ['name', 'description', 'price', 'image'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
