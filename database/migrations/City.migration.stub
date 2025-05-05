<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Required for DB::raw

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the 'cities' table based on the provided SQL schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            // Define 'id' column: mediumint unsigned, auto-incrementing primary key
            // SQL: `id` mediumint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->mediumIncrements('id');

            // Define 'name' column: varchar(255), not null
            // SQL: `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('name'); // Defaults to varchar(255) and NOT NULL

            // Define 'state_id' column: mediumint unsigned, not null
            // SQL: `state_id` mediumint unsigned NOT NULL
            $table->unsignedMediumInteger('state_id');

            // Define 'state_code' column: varchar(255), not null
            // SQL: `state_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
            $table->string('state_code');

            // Define 'country_id' column: mediumint unsigned, not null
            // SQL: `country_id` mediumint unsigned NOT NULL
            $table->unsignedMediumInteger('country_id');

            // Define 'country_code' column: char(2), not null
            // SQL: `country_code` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
            $table->char('country_code', 2);

            // Define 'latitude' column: decimal(10, 8), not null
            // SQL: `latitude` decimal(10,8) NOT NULL
            $table->decimal('latitude', 10, 8);

            // Define 'longitude' column: decimal(11, 8), not null
            // SQL: `longitude` decimal(11,8) NOT NULL
            $table->decimal('longitude', 11, 8);

            // Define 'created_at' column: timestamp, not null, specific default value
            // SQL: `created_at` timestamp NOT NULL DEFAULT '2013-12-31 22:31:01'
            // Note: Using the specific default from SQL. Laravel's standard timestamps() behaves differently.
            $table->timestamp('created_at')->default(DB::raw("'2013-12-31 22:31:01'"));

            // Define 'updated_at' column: timestamp, not null, default current timestamp, auto-update on row change
            // SQL: `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            // Use Laravel's helper for ON UPDATE CURRENT_TIMESTAMP functionality
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Define 'flag' column: tinyint(1) (boolean), not null, default 1 (true)
            // SQL: `flag` tinyint(1) NOT NULL DEFAULT '1'
            $table->boolean('flag')->default(true); // boolean is often mapped to tinyint(1)

            // Define 'wikiDataId' column: varchar(255), nullable, with comment
            // SQL: `wikiDataId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Rapid API GeoDB Cities'
            $table->string('wikiDataId')->nullable()->comment('Rapid API GeoDB Cities');

            // Define indexes based on SQL KEY definitions
            // SQL: KEY `cities_test_ibfk_1` (`state_id`)
            $table->index('state_id'); // Explicitly add index for state_id

            // SQL: KEY `cities_test_ibfk_2` (`country_id`)
            $table->index('country_id'); // Explicitly add index for country_id

            // Define foreign key constraints
            // Prerequisites: 'states' and 'countries' tables must exist with compatible 'id' columns.
            // SQL: CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`)
            $table->foreign('state_id')->references('id')->on('states');

            // SQL: CONSTRAINT `cities_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the 'cities' table if it exists.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
