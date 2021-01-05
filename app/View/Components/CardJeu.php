<?php

namespace App\View\Components;

use App\Models\Jeu;
use Illuminate\View\Component;

class CardJeu extends Component {
    public $jeu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Jeu $jeu) {
        $this->jeu = $jeu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render() {
        return view('components.card-jeu');
    }
}
