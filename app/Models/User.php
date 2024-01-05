<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use App\Library\Enum;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Vite;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'avatar',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $appends = [
        'full_name'
    ];

    public $afterCommit = true;

    public function operator()
    {
        return $this->belongsTo(self::class, 'operator_id');
    }

    /*=====================Helper Methods======================*/
    public function getFullNameAttribute()
    {
        $name = $this->first_name;

        $name .= ' ' . $this->last_name;

        return $name;
    }

    public function getIsAdultAttribute()
    {
        return Carbon::parse($this->dob)->diffInYears(now()) >= 18;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->diffInYears(now());
    }

    public static function getAuthUser()
    {
        return auth()->user();
    }

    public static function getUsersByType(string $type)
    {
        return self::where('user_type', $type)->get();
    }


    public function getAvatar(): string
    {
        $path = public_path($this->avatar);

        if ($this->avatar && is_file($path) && file_exists($path)) {
            return asset($this->avatar);
        }

        return Vite::asset(Enum::NO_AVATAR_PATH);
    }

    public function getPhotoId(): string
    {
        $path = public_path($this->photo_id);

        if ($this->photo_id && is_file($path) && file_exists($path)) {
            return asset($this->photo_id);
        }

        return Vite::asset(Enum::NO_IMAGE_PATH);
    }

    public static function getActiveEmployee()
    {
        return self::with('employee')
                    ->where('user_type', Enum::USER_TYPE_EMPLOYEE)
                    ->where('status', Enum::USER_STATUS_ACTIVE)
                    ->get();
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class)->withTimestamps();
    }

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class)->withTimestamps();
    }
}
