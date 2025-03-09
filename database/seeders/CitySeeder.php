<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Agadir', 'Aït Melloul', 'Al Hoceima', 'Azemmour', 'Azrou', 'Beni Mellal', 'Berkane', 'Berrechid',
            'Casablanca', 'Chefchaouen', 'Chichaoua', 'Dakhla', 'El Jadida', 'El Kelaa des Sraghna', 'Errachidia',
            'Essaouira', 'Fès', 'Figuig', 'Guelmim', 'Guercif', 'Ifrane', 'Imzouren', 'Jerada', 'Kénitra',
            'Khemisset', 'Khenifra', 'Khouribga', 'Laayoune', 'Larache', 'Marrakech', 'Martil', 'Meknès',
            'Midar', 'Midelt', 'Mohammedia', 'Nador', 'Ouarzazate', 'Oued Zem', 'Oujda', 'Rabat', 'Safi',
            'Salé', 'Sefrou', 'Settat', 'Sidi Bennour', 'Sidi Ifni', 'Sidi Kacem', 'Sidi Slimane', 'Skhirate',
            'Souk El Arbaa', 'Tan-Tan', 'Tanger', 'Taounate', 'Taroudant', 'Taza', 'Témara', 'Tetouan', 'Tiflet',
            'Tinghir', 'Tiznit', 'Youssoufia', 'Zagora', 'Akhfenir', 'Asilah', 'Ben Guerir', 'Bouarfa', 'Boujdour',
            'Boulemane', 'Chichaoua', 'Demnate', 'Fquih Ben Salah', 'Inezgane', 'Kasba Tadla', 'Kelaat Mgouna',
            'Lqliaa', 'Mechraa Bel Ksiri', 'Moulay Bousselham', 'Moulay Driss Zerhoun', 'Oulad Teima', 'Rissani',
            'Saidia', 'Sebt Gzoula', 'Sidi Harazem', 'Sidi Yahya El Gharb', 'Smara', 'Tahala', 'Tamellalt',
            'Tarfaya', 'Targuist', 'Taourirt', 'Tichka', 'Tifelt', 'Tinghir', 'Zemmour', 'Zaïo', 'Zerhoun',
            'Ait Ourir', 'Amizmiz', 'Azilal', 'Bab Berred', 'Bab Taza', 'Bejaad', 'Biougra', 'Bouknadel',
            'Dcheira El Jihadia', 'Drarga', 'El Aioun', 'El Hajeb', 'El Ksiba', 'Farkhana', 'Guigou', 'Haj Kaddour',
            'Harhoura', 'Jorf El Malha', 'Karia Ba Mohamed', 'Khemis Zemamra', 'Laayoune Plage', 'Lakhsas',
            'Lalla Mimouna', 'Moulay Abdallah', 'Oualidia', 'Ouazzane', 'Oulad M\'rah', 'Oulad Yaich', 'Ribat El Kheir',
            'Sidi Bouzid', 'Sidi Smaïl', 'Souk Sebt Oulad Nemma', 'Tainaste', 'Taliouine', 'Tamri', 'Taounate',
            'Tata', 'Tichla', 'Tifni', 'Touissit', 'Zawyat Cheikh', 'Zeghanghane', 'Lkhnichat', 'Ait Melloul',
            'Tamallalt', 'Tafraout', 'Zaio', 'Assa', 'Tighassaline', 'Sidi Bettache', 'Bouizakarne', 'Sidi Yahya Ou Saad',
            'Boumia', 'Sidi Moussa Ben Ali'
        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city,
                'status' => 'active', // Or set a default status, e.g., 'inactive' if needed
            ]);
        }
    }
}
