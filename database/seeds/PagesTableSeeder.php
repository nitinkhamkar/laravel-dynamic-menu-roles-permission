<?php

use Illuminate\Database\Seeder;
use App\Model\Page;
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::firstOrCreate(['parent_id'=>0,'title'=>'Dashboard','link'=>'dashboard','slug'=>'dashboard']);
        Page::firstOrCreate(['parent_id'=>0,'title'=>'Master','link'=>'master','slug'=>'master']);
        Page::firstOrCreate(['parent_id'=>2,'title'=>'Roles','link'=>'roles','slug'=>'roles']);
        Page::firstOrCreate(['parent_id'=>3,'title'=>'Roles List','link'=>'roles/index','slug'=>'roles-index']);
        Page::firstOrCreate(['parent_id'=>3,'title'=>'Add Role','link'=>'roles/create','slug'=>'roles-create']);
    
        //Page::firstOrCreate(['parent_id'=>0,'title'=>'Blog','link'=>'blog','slug'=>'blog']);
       
    }
}
