<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Evento que se ejecuta cuando un usuario es creado, osea cuando un usaurio se crea se crea un nuevo perfil
    protected static function boot()
    {
        parent::boot();

        //Asignar perfil una vez se haya creado un usuario nuevo
        Static::created(function ($user){
            $user->perfil()->create();
        });
    }



    /** Relacion de 1:n 1 a muchos de usuario cursos */
    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }



    //Relación 1 a 1 , 1 usuario 1 perfil
    public function perfil()
    {
        return $this->hasOne(perfil::class);
    }
}
