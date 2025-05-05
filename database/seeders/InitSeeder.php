<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Person;
use App\Models\PersonAffiliation;
use App\Models\CompanyArea;
use App\Models\CompanyProfile;
use App\Models\Profession;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            /** Populate World Regions, Countries, States and Cities */
            WorldAddressSeeder::class, 
            EmploymentStatusSeeder::class,
            BusinessTypeSeeder::class,
            RolesSeeder::class
        ]);

        $now = Carbon::now()->toDateTimeString();

        $person = Person::firstOrCreate([
            'employee_id'       => config('bee.company.owner.employee_id')
        ],[
            'first_name'        => config('bee.company.owner.first_name'),
            'first_name'        => config('bee.company.owner.middle_name'),
            'last_name'         => config('bee.company.owner.last_name'),
            'birth_date'        => config('bee.company.owner.birth_date'),
            'birth_place'       => config('bee.company.owner.birth_place'),
            'gender'            => config('bee.company.owner.gender'),
            'citizenship_id'    => config('bee.company.owner.citizenship_id'),
        ]);
        
        $user = User::firstOrcreate([
            'person_id'         => $person->id,
        ],[
            'password'          => Hash::make(config('bee.company.owner.password')),
            'email'             => config('bee.company.owner.email'),
            'email_verified_at' => $now
        ]);

        $user->syncRoles(['super_admin']);

        $company = CompanyProfile::firstOrCreate([
            'business_name'             => config('bee.company.profile.business_name')
        ],[
            'created_by'                => $user->id,
            'city_id'                   => config('bee.company.profile.city_id'),
            'business_classification'   => config('bee.company.profile.business_classification'),
            'business_scope'            => config('bee.company.profile.business_scope'),
            'business_type_id'          => config('bee.company.profile.business_type_id'),
            'date_started'              => config('bee.company.profile.start_date')
        ]);

        $areas = config('bee.company.areas');
        
        foreach($areas as $area)
            CompanyArea::updateOrCreate([
                'name'          => $area,
                'company_id'    => 1,
            ],[
                'headed_by'     => $person->id,
                'city_id'       => $company->city_id
            ]);

        $positions = config('bee.company.positions');

        foreach($positions as $position)
            Position::updateOrCreate([
                'title'         => $position['title'],
                'profession_id' => Profession::firstOrCreate(['title' => $position['profession']])->id,
            ]);
        
        $affiliation = PersonAffiliation::firstOrCreate([
            'person_id'         =>  $person->id,
            'company_area_id'   =>  CompanyArea::firstOrCreate([
                                        'name'          => config('bee.company.owner.area'),
                                        'company_id'    => $company->id
                                    ],[
                                        'headed_by'     => $person->id,
                                        'city_id'       => $company->city_id
                                    ])->id,
            'position_id'       =>  Position::firstOrCreate([
                                        'title' => config('bee.company.owner.position.title')
                                    ],[
                                        'profession_id' => Profession::firstOrCreate(['title' => config('bee.company.owner.position.profession')])->id
                                    ])->id
        ],[
            'affiliation_level' => 'Executive',
            'start_date'        => config('bee.company.profile.start_date')
        ]);
    }
}
