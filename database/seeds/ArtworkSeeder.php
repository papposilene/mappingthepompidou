<?php

use App\Models\Acquisition;
use App\Models\Artist;
use App\Models\ArtistMovement;
use App\Models\Artwork;
use App\Models\ArtworkMovement;
use App\Models\Department;
use App\Models\Movement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Drop the table
        //DB::table('artist_movements')->delete();
        //DB::table('artwork_movements')->delete();
        //DB::table('acquisition_types')->delete();
        //DB::table('artworks')->delete();
        //DB::table('artists')->delete();
        //DB::table('museum_departments')->delete();
        //DB::table('movements')->delete();

        // Retrieve the dump of Navigart
        $artworksFile = File::get('database/data/cnam.navigart.json');
        $artworksData = json_decode($artworksFile);

        foreach ($artworksData as $data)
        {
            // Find (or create) the museum department
            $departmentData = Department::updateOrCreate(
                [
                    'department_slug' => Str::slug($data->department, '-'),
                ],
                [
                    'department_name' => $data->department,
                ]
            );

            // Find (or create) the artist
            $artistData = Artist::updateOrCreate(
                [
                    'artist_name' => $data->artist_name,
                ],
                [
                    'navigart_id' => $data->artist_id,
                    'artist_type' => $data->artist_type,
                    'artist_gender' => $data->artist_gender,
                    'artist_birth' => (int) $data->artist_birth,
                    'artist_death' => (int) $data->artist_death,
                    'artist_nationality' => $data->artist_nationality,
                ]
            );

            // Find (or create) the acquisition type
            $cleanAcquisition = ($data->acquisition_type ? $data->acquisition_type : 'Unknown');
            $cleanAcquisition = ucfirst($cleanAcquisition);
            $acquisitionData = Acquisition::updateOrCreate(
                [
                    'acquisition_slug' => Str::slug($data->acquisition_type, '-'),
                ],
                [
                    'acquisition_name' => $cleanAcquisition,
                ]
            );

            // Seed the artworks table
            // We hope that Navigart ID is unique...
            $artworkData = Artwork::updateOrCreate(
                [
                    'navigart_id' => $data->id,
                ],
                [
                    'department_uuid' => $departmentData->uuid,
                    'artist_uuid' => $artistData->uuid,
                    'object_inventory' => $data->object_inventory,
                    'object_title' => $data->object_title,
                    'object_date' => $data->object_date,
                    'object_type' => $data->object_type,
                    'object_technique' => $data->object_technique,
                    'object_height' => $data->object_height,
                    'object_width' => $data->object_width,
                    'object_depth' => $data->object_depth,
                    'object_weight' => $data->object_weight,
                    'object_copyright' => $data->object_copyright,
                    'object_visibility' => (bool) $data->object_visibility,
                    'acquisition_uuid' => $acquisitionData->uuid,
                    'acquisition_date' => (integer) $data->acquisition_date,
                ]
            );

            // Seed the art movements table
            $movementName = ($data->art_movement ? $data->art_movement : 'Unknown');
            $movementNames = Str::of($movementName)->split('/, +/');
            foreach($movementNames as $movement)
            {
                $movementData = Movement::updateOrCreate(
                    [
                        'movement_slug' => Str::of($movement)->slug('-'),
                    ],
                    [
                        'movement_name' => ucfirst($movement),
                    ]
                );

                // updateOrCreate, or it will be have a lot of duplicate movements for a same artist
                ArtistMovement::updateOrCreate([
                    'artist_uuid' => $artistData->uuid,
                    'movement_uuid' => $movementData->uuid,
                ]);

                ArtworkMovement::create([
                    'artwork_uuid' => $artworkData->uuid,
                    'movement_uuid' => $movementData->uuid,
                ]);
            }
        }
    }
}
