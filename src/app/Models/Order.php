<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 */
class Order extends Model
{
    /** @var string $table */
    protected $table = 'pedido';

    /** @var string $primaryKey */
    protected $primaryKey = 'id';

    /** @var array $fillable*/
    protected $fillable = [
        'id',
        'numpedido',
        'idcliente',
        'idticket'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'idcliente', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id', 'idticket');
    }
}
