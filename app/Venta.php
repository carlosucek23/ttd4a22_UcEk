<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    //
    protected $with=['detalles'];
    protected $table='ventas';
    protected $primaryKey='folio';
    public $incrementing=false;
    public $timestamps=false;

    protected $fillable=[
    	'folio',
    	'fecha_venta',
    	'num_articulos',
    	'subtotal',
    	'iva',
    	'total'
    ];
    public function detalles(){
        return $this->hasMany('App\DetalleVenta','folio',);
        }
}
