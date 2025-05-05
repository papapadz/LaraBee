<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Although not strictly needed here, good practice to include if using DB::raw elsewhere

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the 'countries' table based on the provided SQL schema.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            // Define 'id' column: mediumint unsigned, auto-incrementing primary key
            // SQL: `id` mediumint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->mediumIncrements('id');

            // Define 'name' column: varchar(100), not null
            // SQL: `name` varchar(100) ... NOT NULL
            $table->string('name', 100);

            // Define 'iso3' column: char(3), nullable
            // SQL: `iso3` char(3) ... DEFAULT NULL
            $table->char('iso3', 3)->nullable();

            // Define 'numeric_code' column: char(3), nullable
            // SQL: `numeric_code` char(3) ... DEFAULT NULL
            $table->char('numeric_code', 3)->nullable();

            // Define 'iso2' column: char(2), nullable
            // SQL: `iso2` char(2) ... DEFAULT NULL
            $table->char('iso2', 2)->nullable();

            // Define 'phonecode' column: varchar(255), nullable
            // SQL: `phonecode` varchar(255) ... DEFAULT NULL
            $table->string('phonecode')->nullable();

            // Define 'capital' column: varchar(255), nullable
            // SQL: `capital` varchar(255) ... DEFAULT NULL
            $table->string('capital')->nullable();

            // Define 'currency' column: varchar(255), nullable
            // SQL: `currency` varchar(255) ... DEFAULT NULL
            $table->string('currency')->nullable();

            // Define 'currency_name' column: varchar(255), nullable
            // SQL: `currency_name` varchar(255) ... DEFAULT NULL
            $table->string('currency_name')->nullable();

            // Define 'currency_symbol' column: varchar(255), nullable
            // SQL: `currency_symbol` varchar(255) ... DEFAULT NULL
            $table->string('currency_symbol')->nullable();

            // Define 'tld' column: varchar(255), nullable (Top-Level Domain)
            // SQL: `tld` varchar(255) ... DEFAULT NULL
            $table->string('tld')->nullable();

            // Define 'native' column: varchar(255), nullable (Native name)
            // SQL: `native` varchar(255) ... DEFAULT NULL
            $table->string('native')->nullable();

            // Define 'region' column: varchar(255), nullable
            // SQL: `region` varchar(255) ... DEFAULT NULL
            $table->string('region')->nullable();

            // Define 'region_id' column: mediumint unsigned, nullable
            // SQL: `region_id` mediumint unsigned DEFAULT NULL
            $table->unsignedMediumInteger('region_id')->nullable();

            // Define 'subregion' column: varchar(255), nullable
            // SQL: `subregion` varchar(255) ... DEFAULT NULL
            $table->string('subregion')->nullable();

            // Define 'subregion_id' column: mediumint unsigned, nullable
            // SQL: `subregion_id` mediumint unsigned DEFAULT NULL
            $table->unsignedMediumInteger('subregion_id')->nullable();

            // Define 'nationality' column: varchar(255), nullable
            // SQL: `nationality` varchar(255) ... DEFAULT NULL
            $table->string('nationality')->nullable();

            // Define 'timezones' column: text, nullable
            // SQL: `timezones` text ...
            $table->text('timezones')->nullable(); // Assuming nullable as NOT NULL is absent

            // Define 'translations' column: text, nullable
            // SQL: `translations` text ...
            $table->text('translations')->nullable(); // Assuming nullable as NOT NULL is absent

            // Define 'latitude' column: decimal(10, 8), nullable
            // SQL: `latitude` decimal(10,8) DEFAULT NULL
            $table->decimal('latitude', 10, 8)->nullable();

            // Define 'longitude' column: decimal(11, 8), nullable
            // SQL: `longitude` decimal(11,8) DEFAULT NULL
            $table->decimal('longitude', 11, 8)->nullable();

            // Define 'emoji' column: varchar(191), nullable
            // SQL: `emoji` varchar(191) ... DEFAULT NULL
            $table->string('emoji', 191)->nullable(); // varchar(191) for utf8mb4 compatibility with older MySQL index limits

            // Define 'emojiU' column: varchar(191), nullable (Unicode representation)
            // SQL: `emojiU` varchar(191) ... DEFAULT NULL
            $table->string('emojiU', 191)->nullable();

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

            // Define indexes based on SQL KEY definitions
            // SQL: KEY `country_continent` (`region_id`)
            $table->index('region_id'); // Explicitly add index for region_id

            // SQL: KEY `country_subregion` (`subregion_id`)
            $table->index('subregion_id'); // Explicitly add index for subregion_id

            // Define foreign key constraints
            // Prerequisites: 'regions' and 'subregions' tables must exist with compatible 'id' columns.
            // SQL: CONSTRAINT `country_continent_final` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`)
            $table->foreign('region_id'/*, 'countries_region_id_foreign'*/) // Optional: specify constraint name if needed
                  ->references('id')->on('regions');

            // SQL: CONSTRAINT `country_subregion_final` FOREIGN KEY (`subregion_id`) REFERENCES `subregions` (`id`)
            $table->foreign('subregion_id'/*, 'countries_subregion_id_foreign'*/) // Optional: specify constraint name if needed
                  ->references('id')->on('subregions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the 'countries' table if it exists.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
