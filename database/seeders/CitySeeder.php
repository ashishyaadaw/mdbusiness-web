<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        // State Name => [Cities]
        $citiesByState = [
            'Andhra Pradesh' => ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore', 'Kurnool', 'Rajahmundry', 'Tirupati'],
            'Arunachal Pradesh' => ['Itanagar', 'Tawang', 'Pasighat'],
            'Assam' => ['Guwahati', 'Silchar', 'Dibrugarh', 'Jorhat', 'Tezpur'],
            'Bihar' => ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur', 'Darbhanga'],
            'Chhattisgarh' => ['Raipur', 'Bhilai', 'Bilaspur', 'Korba'],
            'Goa' => ['Panaji', 'Margao', 'Vasco da Gama', 'Mapusa'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar', 'Jamnagar', 'Gandhinagar'],
            'Haryana' => ['Gurugram', 'Faridabad', 'Panipat', 'Ambala', 'Karnal', 'Hisar'],
            'Himachal Pradesh' => ['Shimla', 'Manali', 'Dharamshala', 'Solan', 'Mandi'],
            'Jharkhand' => ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro'],
            'Karnataka' => ['Bengaluru', 'Mysuru', 'Mangaluru', 'Hubli-Dharwad', 'Belagavi', 'Gulbarga', 'Davangere'],
            'Kerala' => ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Thrissur', 'Kollam', 'Kannur', 'Alappuzha'],
            'Madhya Pradesh' => ['Bhopal', 'Indore', 'Gwalior', 'Jabalpur', 'Ujjain', 'Sagar'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Nashik', 'Aurangabad', 'Solapur', 'Thane', 'Navi Mumbai', 'Kolhapur', 'Amravati'],
            'Manipur' => ['Imphal', 'Thoubal'],
            'Meghalaya' => ['Shillong', 'Tura'],
            'Mizoram' => ['Aizawl', 'Lunglei'],
            'Nagaland' => ['Kohima', 'Dimapur'],
            'Odisha' => ['Bhubaneswar', 'Cuttack', 'Rourkela', 'Berhampur', 'Sambalpur'],
            'Punjab' => ['Ludhiana', 'Amritsar', 'Jalandhar', 'Patiala', 'Bathinda', 'Mohali'],
            'Rajasthan' => ['Jaipur', 'Jodhpur', 'Udaipur', 'Kota', 'Ajmer', 'Bikaner', 'Alwar'],
            'Sikkim' => ['Gangtok', 'Namchi'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Tiruchirappalli', 'Salem', 'Tirunelveli', 'Erode', 'Vellore'],
            'Telangana' => ['Hyderabad', 'Warangal', 'Nizamabad', 'Karimnagar', 'Khammam'],
            'Tripura' => ['Agartala', 'Udaipur'],
            'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Ghaziabad', 'Agra', 'Varanasi', 'Meerut', 'Prayagraj', 'Noida', 'Gorakhpur'],
            'Uttarakhand' => ['Dehradun', 'Haridwar', 'Roorkee', 'Haldwani', 'Rishikesh'],
            'West Bengal' => ['Kolkata', 'Howrah', 'Durgapur', 'Asansol', 'Siliguri', 'Darjeeling'],
            'Andaman and Nicobar Islands' => ['Port Blair'],
            'Chandigarh' => ['Chandigarh'],
            'Dadra and Nagar Haveli and Daman and Diu' => ['Daman', 'Diu', 'Silvassa'],
            'Delhi' => ['New Delhi', 'North Delhi', 'South Delhi', 'East Delhi', 'West Delhi'],
            'Jammu and Kashmir' => ['Srinagar', 'Jammu', 'Anantnag'],
            'Ladakh' => ['Leh', 'Kargil'],
            'Lakshadweep' => ['Kavaratti'],
            'Puducherry' => ['Puducherry', 'Karaikal'],
        ];

        foreach ($citiesByState as $stateName => $cities) {
            // Find the state ID by name
            $state = State::where('name', $stateName)->first();

            if ($state) {
                foreach ($cities as $cityName) {
                    City::firstOrCreate([
                        'name' => $cityName,
                        'state_id' => $state->id,
                    ]);
                }
            }
        }
    }
}
