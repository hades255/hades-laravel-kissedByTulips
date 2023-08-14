<?php

use Illuminate\Database\Seeder;
use App\Timezone;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      Timezone::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      Timezone::create(['timezone' =>'Pacific/Midway','name'=>'(GMT -11:00) Midway Island, Samoa' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Adak','name'=>'(GMT -10:00) Hawai' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Anchorage','name'=>'(GMT -9:00) Alaska' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Los_Angeles','name'=>'(GMT -8:00) Pacific Time (US & Canada)' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Denver','name'=>'(GMT -7:00) Mountain Time (US & Canada)' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Chicago','name'=>'(GMT -6:00) Central Time (US & Canada), Mexico City' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/New_York','name'=>'(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Halifax','name'=>'(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/St_Johns','name'=>'(GMT -3:30) Newfoundland' , 'active'=> 1]);
      Timezone::create(['timezone' =>'America/Argentina/Buenos_Aires','name'=>'(GMT -3:00) Brazil, Buenos Aires, Georgetown' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Atlantic/South_Georgia','name'=>'(GMT -2:00) Mid-Atlantic' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Atlantic/Azores','name'=>'(GMT -1:00 hour) Azores, Cape Verde Islands' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Europe/Dublin','name'=>'(GMT) Western Europe Time, London, Lisbon, Casablanca' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Europe/Belgrade','name'=>'(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Europe/Minsk','name'=>'(GMT +2:00) Kaliningrad, South Africa' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Kuwait','name'=>'(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Tehran','name'=>'(GMT +3:30) Tehran' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Muscat','name'=>'(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Kabul','name'=>'(GMT +4:30) Kabu' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Karachi','name'=>'(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Kolkata','name'=>'(GMT +5:30) Bombay, Calcutta, Madras, New Delhi' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Kathmandu','name'=>'(GMT +5:45) Kathmandu' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Dhaka','name'=>'(GMT +6:00) Almaty, Dhaka, Colombo' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Bangkok','name'=>'(GMT +7:00) Bangkok, Hanoi, Jakarta' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Brunei','name'=>'(GMT +8:00) Beijing, Perth, Singapore, Hong Kong' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Asia/Seoul','name'=>'(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Australia/Darwin','name'=>'(GMT +9:30) Adelaide, Darwin' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Australia/Brisbane','name'=>'(GMT +10:00) Eastern Australia, Guam, Vladivostok' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Australia/Canberra','name'=>'(GMT +11:00) Magadan, Solomon Islands, New Caledonia' , 'active'=> 1]);
      Timezone::create(['timezone' =>'Pacific/Fiji','name'=>'(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka' , 'active'=> 1]);
    }
}
