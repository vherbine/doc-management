<?php

use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	DB::table('documents')->delete();
	$json = File::get("database/data/data.json");
	$data = json_decode($json, true);

	foreach ($data as $data_arr) {
	  DB::table('documents')->insert([
            'content' => json_encode($data_arr['content']),
            'meta' => json_encode($data_arr['meta']),
          ]);
        }
    }
}
