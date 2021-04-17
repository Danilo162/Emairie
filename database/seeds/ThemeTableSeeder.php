<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
          "amber",
          "black",
          "blue",
          "blue-grey",
          "brown",
          "cyan",
          "deep-orange",
          "deep-purple",
          "green",
          "grey",
          "indigo",
          "light-blue",
          "lime",
          "orange",
          "pink",
          "purple",
          "red",
          "teal",
          "yellow",

        ];
        \App\Models\Themes::query()->truncate();
        foreach ($themes as $theme){
            \App\Models\Themes::create([
                "name"=>$theme
            ]);
        }
    }
}
