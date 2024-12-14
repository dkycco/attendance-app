<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        
        for ($i=1; $i <= 5; $i++) {
            $data[] = [
                'name' => "Ruangan $i",
                'room_location' => 'Gedung FTI'
            ];
        }
        Room::insert($data);
    }
}
