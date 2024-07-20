<?php

namespace App\Livewire\Fasilitas;

use Livewire\Component;

class Makan extends Component {
    public $title = 'Makan Siang';

    public $qrCodeScanned = '';
    protected $listeners = ['qrCodeScanned'];
    public function qrCodeScanned($decodedText) {
        $this->qrCodeScanned = $decodedText;
    }

    public function render() {
        return view('livewire.fasilitas.makan')->layout('components.layouts.app', [
            'menu' => 'panel',
        ]);
    }
}
