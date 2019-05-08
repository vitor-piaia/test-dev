<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App\Models
 */
class Ticket extends Model
{
    /** @var string $table */
    protected $table = 'ticket';

    /** @var string $primaryKey */
    protected $primaryKey = 'id';

    /** @var array $fillable*/
    protected $fillable = [
        'id',
        'titulo',
        'descricao'
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

    public function order()
    {
        return $this->hasOne(Order::class, 'idticket', 'id');
    }
}
