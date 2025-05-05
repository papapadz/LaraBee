<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Keep for consistency, though not used directly here

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the 'states' table based on the provided SQL schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            // Define 'id' column: mediumint unsigned, auto-incrementing primary key
            // SQL: `id` mediumint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->mediumIncrements('id');

            // Define 'name' column: varchar(255), not null
            // SQL: `name` varchar(255) ... NOT NULL
            $table->string('name'); // Defaults to varchar(255)

            // Define 'country_id' column: mediumint unsigned, not null
            // SQL: `country_id` mediumint unsigned NOT NULL
            $table->unsignedMediumInteger('country_id');

            // Define 'country_code' column: char(2), not null
            // SQL: `country_code` char(2) ... NOT NULL
            $table->char('country_code', 2);

            // Define 'fips_code' column: varchar(255), nullable
            // SQL: `fips_code` varchar(255) ... DEFAULT NULL
            $table->string('fips_code')->nullable();

            // Define 'iso2' column: varchar(255), nullable
            // SQL: `iso2` varchar(255) ... DEFAULT NULL
            $table->string('iso2')->nullable();

            // Define 'type' column: varchar(191), nullable
            // SQL: `type` varchar(191) ... DEFAULT NULL
            $table->string('type', 191)->nullable(); // varchar(191) for utf8mb4 index compatibility

            // Define 'latitude' column: decimal(10, 8), nullable
            // SQL: `latitude` decimal(10,8) DEFAULT NULL
            $table->decimal('latitude', 10, 8)->nullable();

            // Define 'longitude' column: decimal(11, 8), nullable
            // SQL: `longitude` decimal(11,8) DEFAULT NULL
            $table->decimal('longitude', 11, 8)->nullable();

            // Define 'created_at' column: timestamp, nullable
            // SQL: `created_at` timestamp NULL DEFAULT NULL
            $table->timestamp('created_at')->nullable();

            // Define 'updated_at' column: timestamp, not null, default current timestamp, auto-update on row change
            // SQL: `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Define 'flag' column: tinyint(1) (boolean), not null, default 1 (true)
            // SQL: `flag` tinyint(1) NOT NULL DEFAULT '1'
            $table->boolean('flag')->default(true);

            // Define 'wikiDataId' column: varchar(255), nullable, with comment
            // SQL: `wikiDataId` varchar(255) ... DEFAULT NULL COMMENT 'Rapid API GeoDB Cities'
            $table->string('wikiDataId')->nullable()->comment('Rapid API GeoDB Cities');

            // Define index based on SQL KEY definition
            // SQL: KEY `country_region` (`country_id`)
            $table->index('country_id'); // Explicitly add index for country_id

            // Define foreign key constraint
            // Prerequisite: 'countries' table must exist with a compatible 'id' column (e.g., mediumIncrements).
            // SQL: CONSTRAINT `country_region_final` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
            $table->foreign('country_id'/*, 'states_country_id_foreign'*/) // Optional: specify constraint name if needed
                  ->references('id')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the 'states' table if it exists.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
};
