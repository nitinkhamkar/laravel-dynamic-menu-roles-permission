# laravel-dynamic-menu-roles-permission laravel verson- 6.*
dynamic menu generation adminb2b template spaties roles and permissions

install package
1.spaties permission
2.lavary-menu



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
    
    
