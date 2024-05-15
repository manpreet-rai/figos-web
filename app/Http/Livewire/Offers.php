<?php

namespace App\Http\Livewire;

use App\Models\Links;
use Livewire\Component;

class Offers extends Component
{
    protected $listeners = ['submitLink', 'syncLink', 'offersReady'];

    public function submitLink($data) {
        try {
            $link = Links::firstOrCreate([
                'offer' => $data[0],
            ]);
            $link->link = $data[1];
            $link->save();
            $this->emit('showNotificationSuccess', 'Offer modified successfully, Don\'t forget to Sync changes if needed');
        } catch (\Exception $exception) {
            $this->emit('showNotificationFailure', "Error occurred while modifying offers, Please try again");
        }
    }

    public function syncLink($data) {
        $location = '';
        if ($data[0][0] == "g") {
            $location = "goraya";
        } else if ($data[0][0] == "n") {
            $location = "nakodar";
        }

        $url = env('FIREBASE_API_URL').'daily';
        $data = array(
            'secret-key' => env('FIREBASE_API_SECRET'),
            'location' => $location,
            'url' => $data[1]);

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );

        try {
            $context  = stream_context_create($options);
            $json = file_get_contents($url, false, $context);

            if ($json === FALSE) {
                $this->emit('showNotificationFailure', "Error occurred while updating offers, Please try again");
            } else {
                $this->emit('showNotificationSuccess', json_decode($json)->response);
            }
        }
        catch (\Exception $exception) {
            $this->emit('showNotificationFailure', "Check your network connection, and try again");
        }
    }

    public function offersReady(){
        $this->emit('fillOffers', Links::all());
    }

    public function render()
    {
        return view('livewire.offers');
    }
}
