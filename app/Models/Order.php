<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'status',
        'date',
    ];

    protected $hidden = [
        'id',
        'number',
        'name',
    ];

    const STATUS_TYPES = ["new-order", "processing", "merrged", "ready", "special-service"];

    public $timestamps = false;

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($entity) {
            $entity->update([
                'number' => "OR{$entity->id}-".auth()->id()
            ]);
        });
    }

    /*====*start mutator laravel ====*\
    /**
     * get User id
     */
    public function getUserIdAttribute()
    {
        return explode('-', $this->attributes['number'])[1];
    }

    /*====*end mutator laravel ====*\

    /**
     * user Relationship.
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
