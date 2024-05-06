<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\ProdutosController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function produtos()
    {
        return $this->hasMany(Produtos::class);
    }

    protected static function booted()
    {
        //adicionar escopo para criar regras que a lista final vai fazer
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy("nome");
        });
    }
}
