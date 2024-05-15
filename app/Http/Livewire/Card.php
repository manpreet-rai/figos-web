<?php

namespace App\Http\Livewire;

use App\Services\SDKFetch;
use Livewire\Component;

class Card extends Component
{
    public $gorayaCount = 0;
    public $gorayaMale = 0;
    public $gorayaFemale = 0;
    public $gorayaVeg = 0;
    public $gorayaNonVeg = 0;

    public $nakodarCount = 0;
    public $nakodarMale = 0;
    public $nakodarFemale = 0;
    public $nakodarVeg = 0;
    public $nakodarNonVeg = 0;

    public $data;

    protected $listeners = ['ready'];

    public function ready() {
        $this->data = SDKFetch::getData();

        if ($this->data == "Cannot get data right now, please try later") {
            $this->emit('showNotificationFailure', "Cannot fetch data from API, Please check network connection");
            return;
        }

        foreach ($this->data as $datum) {
            $decoded = $datum[1];

            if ($decoded->location == "Goraya") {
                $this->gorayaCount++;
            } else if ($decoded->location == "Nakodar") {
                $this->nakodarCount++;
            }

            if ($decoded->location == "Goraya" and $decoded->gender == "Male") {
                $this->gorayaMale++;
            } else if ($decoded->location == "Goraya" and $decoded->gender == "Female") {
                $this->gorayaFemale++;
            }

            if ($decoded->location == "Goraya" and $decoded->diet == "Vegetarian") {
                $this->gorayaVeg++;
            } else if ($decoded->location == "Goraya" and $decoded->diet == "Non-Vegetarian") {
                $this->gorayaNonVeg++;
            }

            if ($decoded->location == "Nakodar" and $decoded->gender == "Male") {
                $this->nakodarMale++;
            } else if ($decoded->location == "Nakodar" and $decoded->gender == "Female") {
                $this->nakodarFemale++;
            }

            if ($decoded->location == "Nakodar" and $decoded->diet == "Vegetarian") {
                $this->nakodarVeg++;
            } else if ($decoded->location == "Nakodar" and $decoded->diet == "Non-Vegetarian") {
                $this->nakodarNonVeg++;
            }
        }
        $this->emit('sharedData', $this->data);
    }

    public function render()
    {
        return view('livewire.card');
    }
}
