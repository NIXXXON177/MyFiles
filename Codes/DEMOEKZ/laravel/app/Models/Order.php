<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'datetime',
        'weight',
        'dimensions',
        'adr_o',
        'adr_d',
        'cargo_id',
        'user_id',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cargo() {
        return $this->belongsTo(Cargo::class);
    }
}
