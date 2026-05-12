<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug', 'type'])]
class Attribute extends Model
{
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
