<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

#[Fillable(['name'])]
class DosageForm extends Model
{
    use HasFactory, HasUuids, Searchable, SoftDeletes;

    public function toSearchableArray()
    {
        return $this->only('name');
    }
}
