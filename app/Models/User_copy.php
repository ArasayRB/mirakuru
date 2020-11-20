<?php


namespace App\Models;

use App\Models\Cuenta;
use App\Models\Hostal;
use App\Models\Pago;
use App\Models\Post;
use App\Models\Reserva;
use App\Models\Role;
use App\Notifications\MirakuruVerifyEmail;
use App\Notifications\MirakuruResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Notifications\ResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
      return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hostales(){
      return $this->hasOne(Hostal::class)->withTimestamps();
    }

    public function reservas(){
      return $this->hasMany(Reserva::class)->withTimestamps();
    }

    public function posts(){
      return $this->hasMany(Post::class)->withTimestamps();
    }

    public function pagos(){
      return $this->hasMany(Pago::class)->withTimestamps();
    }

    public function cuentas(){
      return $this->hasMany(Cuenta::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                 return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function sendEmailVerificationNotification()
  {
      $this->notify(new MirakuruVerifyEmail);
  }

  public function sendPasswordResetNotification($token)
    {
        $this->notify(new MirakuruResetPassword($token));
    }

}
