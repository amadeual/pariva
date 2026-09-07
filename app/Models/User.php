<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'photos',
        'age',
        'location',
        'profession',
        'bio',
        'interests',
        'gender',
        'interested_in',
        'max_distance',
        'is_verified',
        'verification_badge',
        'roses_count',
        'superlikes_count',
        'boosted_until',
        'featured_until',
        'featured_plan',
        'see_likes_until',
        'is_premium',
        'direct_chat_credits',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'interests' => 'array',
        'photos' => 'array',
        'boosted_until' => 'datetime',
        'featured_until' => 'datetime',
        'see_likes_until' => 'datetime',
        'is_premium' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function isBoosted(): bool
    {
        return $this->boosted_until && $this->boosted_until->isFuture();
    }

    public function isFeatured(): bool
    {
        return $this->featured_until && $this->featured_until->isFuture();
    }

    public function canSeeWhoLiked(): bool
    {
        return $this->is_premium || ($this->see_likes_until && $this->see_likes_until->isFuture());
    }

    public function verifications()
    {
        return $this->hasMany(UserVerification::class);
    }

    public function latestVerification()
    {
        return $this->hasOne(UserVerification::class)->latestOfMany();
    }

    public function getVerificationStatusAttribute(): string
    {
        if ($this->is_verified) {
            return 'approved';
        }
        $latest = $this->latestVerification;
        return $latest ? $latest->status : 'unverified';
    }

    public function getAvatarUrlAttribute(): string
    {
        $photos = $this->photos ?? [];
        if (!empty($photos) && isset($photos[0])) {
            return str_starts_with($photos[0], 'http')
                ? $photos[0]
                : asset('storage/' . $photos[0]);
        }

        if (!empty($this->avatar)) {
            return str_starts_with($this->avatar, 'http')
                ? $this->avatar
                : asset('storage/' . $this->avatar);
        }

        return asset('images/avatars/placeholder.jpg');
    }

    public function getPhotoUrlsAttribute(): array
    {
        $photos = $this->photos ?? [];
        if (empty($photos)) {
            if (!empty($this->avatar)) {
                $photos = [$this->avatar];
            } else {
                return [asset('images/avatars/placeholder.jpg')];
            }
        }

        return array_map(function ($p) {
            return str_starts_with($p, 'http') ? $p : asset('storage/' . $p);
        }, $photos);
    }

    public function unreadMessagesCount(): int
    {
        return \App\Models\Message::where('receiver_id', $this->id)->where('is_read', false)->count();
    }

    public function pendingDatesCount(): int
    {
        return \App\Models\Date::where('target_user_id', $this->id)
            ->where('status', 'pendente')
            ->count();
    }

    public function getMatches()
    {
        $likedUserIds = UserLike::where('user_id', $this->id)->pluck('liked_user_id');
        $matchedUserIds = UserLike::where('liked_user_id', $this->id)
            ->whereIn('user_id', $likedUserIds)
            ->pluck('user_id');

        $matches = User::whereIn('id', $matchedUserIds)->get();

        if ($matches->isEmpty()) {
            $matches = User::where('id', '!=', $this->id)->take(5)->get();
        }

        return $matches;
    }
}

