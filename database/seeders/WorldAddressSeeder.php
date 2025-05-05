<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Eloquent;
use DB;
use File;
use App\Models\Address\Country;
use App\Models\Address\State;
use App\Models\Address\City;

class WorldAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dbPath = base_path().'/database';
        $jsonCountries = File::get($dbPath.'/json/countries.json');
        $jsonWorldRegions = File::get($dbPath.'/json/regions.json');
        $jsonWorldSubRegions = File::get($dbPath.'/json/subregions.json');
        
        $jsonRegions = File::get($dbPath.'/json/refregion.json');
        $jsonProvinces = File::get($dbPath.'/json/refprovince.json');
        $jsonCities = File::get($dbPath.'/json/refcitymun.json');

        foreach (json_decode($jsonWorldRegions) as $item)
            DB::table('regions')->insert([
                'id' => $item->id,
                'name' => $item->name,
                'translations' => $item->translations,
                'created_at' => now(),
                'updated_at' => now(),
                'flag' => $item->flag,
                'wikiDataId' => $item->wikiDataId,
            ]);

        foreach (json_decode($jsonWorldSubRegions) as $item)
            DB::table('subregions')->insert([
                'id' => $item->id,
                'name' => $item->name,
                'translations' => $item->translations,
                'region_id' => $item->region_id,
                'created_at' => now(),
                'updated_at' => now(),
                'flag' => $item->flag,
                'wikiDataId' => $item->wikiDataId,
            ]);
        
        foreach (json_decode($jsonCountries) as $item)
        DB::table('countries')->insert([
            'id' => $item->id,
            'name' => $item->name,
            'iso3' => $item->iso3,
            'numeric_code' => $item->numeric_code,
            'iso2' => $item->iso2,
            'phonecode' => $item->phonecode,
            'capital' => $item->capital,
            'currency' => $item->currency,
            'currency_name' => $item->currency_name,
            'currency_symbol' => $item->currency_symbol,
            'tld' => $item->tld,
            'native' => $item->native,
            'region' => $item->region,
            'region_id' => $item->region_id,
            'subregion' => $item->subregion,
            'subregion_id' => $item->subregion_id,
            'nationality' => $item->nationality,
            'timezones' => $item->timezones,
            'translations' => $item->translations,
            'latitude' => $item->latitude,
            'longitude' => $item->longitude,
            'emoji' => $item->emoji,
            'emojiU' => $item->emojiU,
            'created_at' => now(),
            'updated_at' => now(),
            'flag' => $item->flag,
            'wikiDataId' => $item->wikiDataId,
        ]);

        foreach (json_decode($jsonRegions) as $item) {
        	State::insert([
                'name' => $item->regDesc,
                'country_id' => 174,
                'country_code' => 'PH',
                'fips_code' => $item->regCode,
                'iso2' => $item->psgcCode,
                'type' => 'region',
                'flag' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        foreach (json_decode($jsonProvinces) as $item) {
        	State::insert([
                'name' => $item->provDesc,
                'country_id' => 174,
                'country_code' => $item->regCode,
                'fips_code' => $item->provCode,
                'iso2' => $item->psgcCode,
                'type' => 'province',
                'flag' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        foreach (json_decode($jsonCities) as $item) {
        	City::insert([
                'name' => $item->citymunDesc,
                'state_id' => State::where('fips_code',$item->provCode)->first()->id,
                'state_code' => $item->citymunCode,
                'country_id' => 174,
                'country_code' => $item->regDesc,
                'flag' => 1,
                'wikiDataId' => $item->psgcCode,
                'latitude' => 0,
                'longitude' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->command->info('Philippines Addresses seeded!');
    }
}
