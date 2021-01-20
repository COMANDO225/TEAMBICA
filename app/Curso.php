<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

    //Campos que se agregaran
    protected $fillable = [
        'titulo', 'descripcion', 'contenido', /*'precio',*/'imagen', 'categoria_id'
    ];
    //Obtiene la categoria del curso via FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaCurso::class);
    }

    //Obtiene la info del usuario via FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
