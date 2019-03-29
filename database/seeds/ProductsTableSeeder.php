<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 115; $i++)  {
            $nameArray = ['SAMSUNG', 'Xiaomi', 'APPLE', 'HUAWEI'];
            $randName  = array_rand($nameArray);
            
            $descriptionArray = [
                'Go big with Mi Max 2\'s gorgeous 6.44" full HD display. It features Sunlight Display, which uses hardware-level algorithms to adjust contrast for each pixel in real time, dramatically improving readability in sunlight.',
                'Adopting the Qualcomm 14nm process MSM8953 CPU, combined with Adreno™ 506 GPU, Mi Max 2 brings strong performance, lower power consumption reduced by 35%. And this device can meet all your needs whatever you are operating.',
                '5300mAh super large built-in battery provides up to 18 hours of video playback on a single charge. Adopting the 9V / 2A Quick Charge 3.0 and Parallel charging technologies , it can replenish over 68% of the battery within only an hour.',
                'Packed with 4GB big RAM, Mi Max 2 brings better user experience. Coupled with 128GB ROM, it is large enough to satisfy your needs for storing tons of APPs, pictures, music and videos. Come with max 128GB expansion.',
            ];
            $randDescription  = array_rand($descriptionArray);
            
            $imageArray = [
                'https://cdn.pixabay.com/photo/2016/01/13/20/50/phone-1138907_960_720.jpg',
                'https://www.publicdomainpictures.net/pictures/40000/nahled/old-mobile-phone-136583737501R.jpg',
                'https://cdn.pixabay.com/photo/2016/09/03/14/45/smartphone-1641909_960_720.jpg',
            ];
            $randImage  = array_rand($imageArray);
            
            DB::table('products')->insert(
                [
                    'name'        => $nameArray[$randName],
                    'description' => $descriptionArray[$randDescription],
                    'image'       => $imageArray[$randImage],
                    'type'        => 'phones',
                    'count'       => mt_rand(15, 100),
                    'price'       => mt_rand(115, 1000),
                ]
            )
            ;
        }
    }
}
