<?php

namespace App\Http\Controllers;

use CURLFile;

class WebController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function live_room()
    {
        $member_api_url = env("API_URL") . '/api/rooms';
        $gen10_api_url = env("API_URL") . '/api/rooms/academy';
        // $api_url = 'https://campaign.showroom-live.com/akb48_sr/data/room_status_list.json';

        // Read JSON file
        $json_data_member = file_get_contents($member_api_url);
        $json_data_gen10 = file_get_contents($gen10_api_url);

        // Decode JSON data into PHP array
        $member_data = json_decode($json_data_member);
        $gen10_data = json_decode($json_data_gen10);
        $gen10 = [];
        for ($i = 0; $i < count($gen10_data); $i++) {

            $member = [
                "id" => $gen10_data[$i]->room_id,
                "name" => $gen10_data[$i]->room_name,
                "url_key" => $gen10_data[$i]->room_url_key,
                "image_url" => $gen10_data[$i]->image,
                "description" => $gen10_data[$i]->description,
                "follower_num" => $gen10_data[$i]->follower_num,
                "is_live" => $gen10_data[$i]->is_onlive,
                "is_party" => $gen10_data[$i]->is_party_enabled,
                "next_live_schedule" => $gen10_data[$i]->next_score
            ];
        
            array_push($gen10, $member);
        }
        $json_gen10 = json_encode($gen10);
        $json_gen10_decode = json_decode($json_gen10);

        $all_member = array_merge($member_data, $json_gen10_decode);

        $roomList = collect($all_member)->sortBy('name')->toArray();

        // $roomList = [];

        // for ($i = 0; $i < count($rooms); $i++) {
        //     $index = $rooms[$i];
        //     if (
        //         str_contains($index->name, "JKT48")
        //     ) {
        //         array_push($roomList,$index);
        //     }
        //   }

        // dd($roomList); exit;

        return view('pages.live-room',compact('roomList'));
    }

    public function send_mess()
    {

        // $message_text = "halo";
        // $secret_token = "5950996746:AAGZZRDcD_2rW3AubcLVpS2Edw3SfGfBiz4";

        // $url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=1456680511";
        // $url = $url . "&text=" . urlencode($message_text);
        // $ch = curl_init();
        // $optArray = array(CURLOPT_URL, CURLOPT_RETURNTRANSFER => true);
        // curl_setopt_array($ch, $optArray);
        // $result = curl_exec($ch);
        // curl_close($ch);

        $apiToken = env("TELEGRAM_TOKEN"); 
 
        $data = [ 
        'chat_id' => '@jeketian_sini', 
        'text' => 'halo',
        'image' => 'https://cdns.klimg.com/resized/1200x600/p/headline/jkt-48-hadir-dengan-konsep-new-era-beri-09714b.jpg' 
        ]; 
        
        $response = file_get_contents("http://api.telegram.org/bot$apiToken/sendMessage?" 
                    . http_build_query($data) );

        // print "sukses";
    }

    public function send_photo(){
   
        $apiToken = env("TELEGRAM_TOKEN"); 

        $data = [
            'chat_id' => '@jeketian_sini', 
            'photo' => 'ttps://cdns.klimg.com/resized/1200x600/p/headline/jkt-48-hadir-dengan-konsep-new-era-beri-09714b.jpg', 
            'caption' => 'Some caption'
          ];

          $response = file_get_contents("http://api.telegram.org/bot$apiToken/sendPhoto?" 
          . http_build_query($data) );
        
        
    }
}
