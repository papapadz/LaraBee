<?php

return [
    'available_models' => [
        'Region',
        'Subregion',
        'Country',
        'State',
        'City',
        
        'BusinessType',
        'EducationType',
        'EmploymentStatus',
        'MandatoryEmploymentMembership',
        'PayrollItem',
        'Profession',
        'Position',
        'ProfessionalCertification',

        'Person',
        'CompanyProfile',
        'CompanyLicense',
        'CompanyArea',
        
        'PersonAddress',
        'PersonAffiliation', 
        'PayrollGeneration',
        'PersonFamilyInfo',
        'PersonEducation',
        'PersonMedicalInfo',
        'PersonContactInfo',
        'PersonEmploymentMembership',
        'PersonCertification',
        'AffiliationPayroll',
        'User'
    ],
    
    'model_namespace' => 'App\Models',
    
    'stub_models_path' => '/database/models/',

    'stub_migrations_path' => '/database/migrations/',

    'migration_path' => database_path('migrations'),

    'spatie' => [
        'roles' => [
            'super_admin','admin','super_user','user'
        ],
        'actions' => [
            'add', 'update', 'delete', 'view'
        ]
    ],

    'company' => [
        'areas' => [
        ],
        'owner' => [
            'employee_id'           => '',
            'first_name'            => '',
            'last_name'             => '',
            'middle_name'           => '',
            'birth_date'            => '',
            'birth_place'           => '',
            'gender'                => '',
            'citizenship_id'        => 1,
            'email'                 => '',
            'password'              => '',
            'position'              => [
                'title'         => '',
                'profession'    => ''
            ],
            'area'                  => ''
        ],
        'positions' => [
            'title'         => '',
            'profession'    => ''
        ],
        'profile' => [
            'business_name'             => '',
            'business_classification'   => '',
            'business_scope'            => '',
            'business_type_id'          => 1,
            'city_id'                   => 1,
            'start_date'                => ''
        ]
    ]
];