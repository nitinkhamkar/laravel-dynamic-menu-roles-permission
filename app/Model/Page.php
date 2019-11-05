<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
     protected $table = 'pages';
    protected $fillable = ['parent_id', 'title', 'link','slug','page_order'];
     /**
     * The pages that belong to the role.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
