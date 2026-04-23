<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use Illuminate\Support\Str;

class GenerateCitySlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate unique slugs for all cities';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Generating city slugs...');

        City::chunk(100, function ($cities) {
            foreach ($cities as $city) {
                // Generate base slug from city name
                $slug = Str::slug($city->name);

                // Check for duplicates
                $count = City::where('slug', $slug)->where('id', '!=', $city->id)->count();
                if ($count > 0) {
                    // Append ID to make it unique
                    $slug = $slug . '-' . $city->id;
                }

                $city->slug = $slug;
                $city->save();

                $this->info("Updated: {$city->name} => {$city->slug}");
            }
        });

        $this->info('All city slugs generated successfully!');
        return 0;
    }
}