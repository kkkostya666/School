<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Observers\UserObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

#[ObservedBy(UserObserver::class)]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'surname',
        'group_id',
        'email',
        'password',
        'address',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'address' => 'array',
            'role' => UserRole::class,
        ];
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'marks')
            ->withPivot('mark');
    }

    public function getGradeClassAttribute()
    {
        $minMark = $this->subjects->min('pivot.mark');

        switch (true) {
            case $minMark == 5:
                return 'great-student';
            case $minMark == 4 :
                return 'good-student';
            default:
                return 'other-student';
        }
    }

    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d-m-Y'),
        );
    }

    public function getAddressArrayAttribute()
    {
        return is_null($this->address) ? '' : implode(', ', array_filter($this->address));
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: function () {
                return json_decode($this->attributes['address'], true);
            },
            set: function ($value) {
                if (is_array($value)) {
                    $value = array_map('ucfirst', $value);
                }

                return json_encode($value);
            });
    }

    public function scopeFilter($query, Request $request)
    {
        return $query->when($request->filled('query'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $name = $request->input('query');
                $q->where('first_name', 'LIKE', "%$name%")
                    ->orWhere('last_name', 'LIKE', "%$name%")
                    ->orWhere('surname', 'LIKE', "%$name%");
            });
        })
            ->when($request->filled('date_of_birth'), function ($query) use ($request) {
                $query->whereDate('date_of_birth', $request->input('date_of_birth'));
            })
            ->when($request->user()->role !== UserRole::ADMIN, function ($query) {
                $query->whereNull('deleted_at');
            });
    }

    public function hasRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? Storage::disk('avatars')->url($this->avatar) : asset('images/default_avatar.jpg');
    }
}
