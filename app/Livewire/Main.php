<?php

namespace App\Livewire;

use Livewire\Component;

class Main extends Component {
    public function render() {
        return view('livewire.mainform')->layout('components.layouts.app', [
            'menu' => 'main',
        ]);
    }
}
