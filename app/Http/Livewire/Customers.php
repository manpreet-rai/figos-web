<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Customers extends Component
{
    public $data;

    protected $listeners = ['sharedDatabase', 'clearOffers', 'sendNotificationsToUsers', 'sendOffersToUsers'];

    public function sharedDatabase($sharedDatabase) {
        $this->data = $sharedDatabase;
    }

    public function sendNotificationsToUsers($notification, $users) {
        $url = env('FIREBASE_API_URL').'notify';
        $data = array(
            'secret-key' => env('FIREBASE_API_SECRET'),
            'notification' => $notification,
            'users' => $users);

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
                $this->emit('showNotificationFailure', "Error occurred while sending notifications, Please try again");
            } else {
                $this->emit('showNotificationSuccess', json_decode($json)->response);
            }
        }
        catch (\Exception $exception) {
            $this->emit('showNotificationFailure', "Check your network connection, and try again");
        }
    }

    public function sendOffersToUsers($offer, $users) {
        $url = env('FIREBASE_API_URL').'offers';
        $data = array(
            'secret-key' => env('FIREBASE_API_SECRET'),
            'offer' => $offer,
            'users' => $users);

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
                $this->emit('showNotificationFailure', "Error occurred while sending offers, Please try again");
            } else {
                $this->emit('showNotificationSuccess', json_decode($json)->response);
            }
        }
        catch (\Exception $exception) {
            $this->emit('showNotificationFailure', "Check your network connection, and try again");
        }
    }

    public function clearOffers($users) {
        $url = env('FIREBASE_API_URL').'clear';
        $data = array(
            'secret-key' => env('FIREBASE_API_SECRET'),
            'users' => $users);

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
                $this->emit('showNotificationFailure', "Error occurred while clearing offers, Please try again");
            } else {
                $this->emit('showNotificationSuccess', json_decode($json)->response);
            }
        }
        catch (\Exception $exception) {
            $this->emit('showNotificationFailure', "Check your network connection, and try again");
        }
    }

    public function render()
    {
        return view('livewire.customers');
    }
}
