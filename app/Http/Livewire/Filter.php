<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Filter extends Component
{
    protected $listeners = ['sharedData', 'continueFilter'];

    public $data;
    public $database = [];
    public $allKeys = [];
    public $choices = array("location"=>"", "gender"=>"", "diet"=>"");

    public function sharedData($sharedData) {
        $this->data = $sharedData;
        $this->performFilter();
    }

    public function locationChanged($choice){
        $this->choices['location'] = $choice;
    }

    public function genderChanged($choice){
        $this->choices['gender'] = $choice;
    }

    public function dietChanged($choice){
        $this->choices['diet'] = $choice;
    }

    public function resetBtnClicked() {
        $this->choices["location"] = "";
        $this->choices["gender"] = "";
        $this->choices["diet"] = "";

        $this->emit('resetSelectBoxes');
        $this->emit('showNotificationSuccess', 'Resetting customer database, Please wait...');
        $this->performFilter();
    }

    public function filterBtnClicked() {
        $this->emit('showNotificationSuccess', 'Filtering database, Please wait...');
        $this->performFilter();
    }

    function performFilter () {
        $this->emit('unselectAll');
    }

    public function continueFilter() {
        $this->database = [];
        $this->allKeys = [];

        $locationMatch = '/^'.$this->choices["location"].'/';
        $genderMatch = '/^'.$this->choices["gender"].'/';
        $dietMatch = '/^'.$this->choices["diet"].'/';

        foreach ($this->data as $datum) {
            if (preg_match($locationMatch, $datum[1]["location"]) and preg_match($genderMatch, $datum[1]["gender"]) and preg_match($dietMatch, $datum[1]["diet"])) {
                array_push($this->database, $datum);
                array_push($this->allKeys, $datum[0]);
            }
        }

        $this->emit('sharedDatabase', $this->database);
        $this->emit('allKeys', $this->allKeys);
    }

    public function render()
    {
        return view('livewire.filter');
    }
}
