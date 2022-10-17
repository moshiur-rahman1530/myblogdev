<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'title_first_letter'=>'K',
            'title_remain_letter'=>'mrBlog',
            'title_sort_desc'=>"Learn about Web Design, Web Development, and Database management.",
            'hero_title'=>"Hi, I'm Md. Moshiur Rahman.",
            'hero_designation'=>"Web Developer",
            'hero_sort_desc'=>'Specialized in a11y and Core Web Vitals',
            'hero_image'=>"https://drive.google.com/file/d/1hek3SoAw9gVq9NLCoDC9d9qM_qIJM7Bi/view?usp=sharing",
            'hero_image_folder_id'=>"",
            'site_logo'=>"https://drive.google.com/file/d/1A-fh8sFyz5kW87ywUGPLJ8a2dhCQR8YS/view?usp=sharing",
            'logo_folder_id'=>"",
        );
        DB::table('settings')->insert($data);
    }
}
