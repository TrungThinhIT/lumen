<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Address.
 *
 * @package namespace App\Entities;
 */
class Address extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ward_id',
        'address',
    ];

    protected $appends = [
        'full_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute(): string
    {
        $ward = Http::get('https://prod-notification.tomonisolution.com/api/wards/' . $this->ward_id);
        return $this->address . ', ' . json_decode($ward->body())->address;
    }
}
