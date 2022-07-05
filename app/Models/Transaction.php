<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PAYMENT_METHOD_SELECT = [
        'paypal'     => 'Paypal',
        'stripe'     => 'Stripe',
        'google pay' => 'Google Pay',
        'apple pay'  => 'Apple Pay',
    ];

    public $table = 'transactions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'transaction',
        'amount',
        'payment_method',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
