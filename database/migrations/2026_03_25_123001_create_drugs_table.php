<?php

use App\Models\DosageForm;
use App\Models\Manufacturer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drugs', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('generic_name');
            $table->string('brand_name')->nullable();
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->string('therapeutic_class')->nullable();
            $table->string('pharmacological_class')->nullable();
            $table->string('atc_code')->nullable();

            $table->foreignIdFor(DosageForm::class)->nullable()->constrained()->cascadeOnDelete();

            $table->string('strength')->nullable();
            $table->string('route_of_administration')->nullable();

            $table->foreignIdFor(Manufacturer::class)->nullable()->constrained()->nullOnDelete();

            $table->boolean('is_prescription_required')->default(true);
            $table->boolean('is_controlled_substance')->default(false);

            $table->string('barcode')->nullable()->unique();
            $table->string('sku')->nullable()->unique();

            $table->string('unit_of_measure')->nullable();
            $table->integer('pack_size')->nullable();

            $table->text('side_effects')->nullable();
            $table->text('contraindications')->nullable();
            $table->text('drug_interactions')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['generic_name', 'brand_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};
