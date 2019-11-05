<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Role extends Model
{   /**
     * The shops that belong to the product.
     */
    public function pages()
    {
       return $this->belongsToMany(Page::class);
    }
}
