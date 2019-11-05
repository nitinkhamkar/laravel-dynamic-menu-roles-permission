# laravel-dynamic-menu-roles-permission
dynamic menu generation adminb2b template spaties roles and permissions

run migration and seeder

open spaties in vender find model name role and paste in end file this function

 /**
     * The roles that belong to the page.
     */
     
     
    public function pages()
    {
       return $this->belongsToMany('App\Model\Page');
    }
    
    it done enjoy
    
    
