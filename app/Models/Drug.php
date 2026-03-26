<?php

namespace App\Models;

use App\Enum\DrugStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

#[Fillable([
    'generic_name',
    'brand_name',
    'description',
    'therapeutic_class',
    'pharmacological_class',
    'atc_code',
    'dosage_form_id',
    'strength',
    'route_of_administration',
    'manufacturer_id',
    'is_prescription_required',
    'is_controlled_substance',
    'barcode',
    'sku',
    'unit_of_measure',
    'pack_size',
    'side_effects',
    'contraindications',
    'drug_interactions',
    'status',
])]
class Drug extends Model
{
    use HasFactory, HasUuids, Searchable, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($drug) {
            if (empty($drug->slug)) {
                $drug->slug = static::generateUniqueSlug($drug->generic_name);
            }
        });

        static::updating(function ($drug) {
            if ($drug->isDirty('generic_name')) {
                $drug->slug = static::generateUniqueSlug($drug->generic_name, $drug->id);
            }
        });
    }

    protected static function generateUniqueSlug($name, $ignoreId = null)
    {
        $originalSlug = $slug = str()->slug($name);

        $counter = 1;

        while (
            self::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = str($originalSlug)->append('-', $counter++)->value();
        }

        return $slug;
    }

    protected function casts()
    {
        return [
            'active' => DrugStatus::class,
        ];
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function dosageForm(): BelongsTo
    {
        return $this->belongsTo(DosageForm::class);
    }

    public function toSearchableArray()
    {
        return $this->only($this->fillable);
    }
}
