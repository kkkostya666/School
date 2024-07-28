<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'marks')
            ->withPivot('mark');
    }

    public function scopeFilter($query, Request $request)
    {
        return $query->where('name', 'LIKE', $request->input('query').'%');
    }
}
