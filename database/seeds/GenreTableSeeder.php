<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values[] = 'ужасы';
        $values[] = 'фантастика';
        $values[] = 'триллер';
        $values[] = 'вестерн';
        $values[] = 'драма';
        $values[] = 'мелодрама';
        $values[] = 'боевик';
        $values[] = 'фэнтези';
        $values[] = 'приключения';
        $values[] = 'комедия';
        $values[] = 'мультфильм';
        $values[] = 'детектив';
        $values[] = 'короткометражка';
        $values[] = 'криминал';
        $values[] = 'мистика';
        $values[] = 'аниме';

        for($i = 0; $i < count($values); $i++){
            DB::table('genres')->insert( ['name' => $values[$i]] );
        }
    }
}
