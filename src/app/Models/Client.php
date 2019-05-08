<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App\Models
 */
class Client extends Model
{
    /** @var string $table */
    protected $table = 'cliente';

    /** @var string $primaryKey */
    protected $primaryKey = 'id';

    /** @var array $fillable*/
    protected $fillable = [
        'id',
        'nome',
        'email'
    ];

    /**
     * Carbon date fields.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'idcliente', 'id');
    }
}