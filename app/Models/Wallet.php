<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected static function booted()
    {
        static::creating(function ($wallet) {
            if (Wallet::where('user_id', $wallet->user_id)->exists()) {
                // Prevent wallet creation if one already exists for this user
                abort(403, 'Wallet already exists for this user.');
            }
        });
    }
}
