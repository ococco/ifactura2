<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoproducto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'tipoproductos';

    protected $fillable = ['descripion'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'idtipoproducto', 'id');
    }
    
}
