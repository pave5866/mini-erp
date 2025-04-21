<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_EMPLOYEE = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status'
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'boolean'
    ];

    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN || $this->role === 'super_admin';
    }

    /**
     * Check if user is manager
     *
     * @return bool
     */
    public function isManager()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to only include users of a given role.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isEmployee()
    {
        return $this->role === self::ROLE_EMPLOYEE;
    }

    /**
     * Kullanıcının belirli bir izne sahip olup olmadığını kontrol eder
     */
    public function hasPermission($permission)
    {
        // Admin kullanıcıları tüm izinlere sahiptir
        if ($this->isAdmin()) {
            return true;
        }
        
        // Manager kullanıcılarına özel izinler
        if ($this->isManager()) {
            $managerPermissions = [
                'list_suppliers', 'view_suppliers', 'create_suppliers', 'edit_suppliers',
                'list_products', 'view_products', 'create_products', 'edit_products',
                'list_customers', 'view_customers', 'create_customers', 'edit_customers',
                'list_sales', 'view_sales', 'create_sales', 'edit_sales',
                'view_reports', 'export_reports'
            ];
            
            return in_array($permission, $managerPermissions);
        }
        
        // Normal çalışanlara sadece belirli izinler
        $employeePermissions = [
            'list_suppliers', 'view_suppliers',
            'list_products', 'view_products',
            'list_customers', 'view_customers',
            'list_sales', 'view_sales'
        ];
        
        return in_array($permission, $employeePermissions);
    }
}
