<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Booking extends Model
{
    use SoftDeletes, HasFactory,MultiTenantModelTrait;

    public $table = 'bookings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Comfirmed',
        '2' => 'Cancelled',
        '0' => 'Pending',
    ];

    protected $fillable = [
        'house_id',
        'names',
        'email',
        'mobile',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class);
    }
}
