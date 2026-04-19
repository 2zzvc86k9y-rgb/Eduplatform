<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userOnline(){
        return Cache::has('user-is-online' . $this->id);

    }


    public static function getpermissionGroup(){
        $permission_group = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_group;
    }

    public static function getpermissionByGroupName($group_name){
        $permissions = DB::table('permissions')->select('name','id')->where('group_name',$group_name)->get();
        return $permissions;
    }

    public static function roleHasPermissions($permissions,$roles){
        $hasPermission = true;
        foreach($permissions as $permission){
            if (!$roles->hasPermissionTo($permission->name)) {
                $hasPermission = false;
            }
        }
        return $hasPermission;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function hasEnrolled($courseId)
    {
        return $this->orders()->where('course_id', $courseId)->exists();
    }

}
