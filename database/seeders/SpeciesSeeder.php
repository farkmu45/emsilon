<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class SpeciesSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->file = '/database/species.csv';
        $this->timestamps = false;
        $this->delimiter = ',';
        $this->foreignKeyCheck = false;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::disableQueryLog();
        parent::run();
    }
}
