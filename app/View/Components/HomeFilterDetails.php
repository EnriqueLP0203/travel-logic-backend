<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class HomeFilterDetails extends Component
{
    /**
     * Bloques de contenido, uno por cada botón del filtro.
     * El orden y las claves deben coincidir con los botones en home-filter-info.
     */
    public array $categorias;

    public function __construct()
    {
        $cardImages = [
            asset('images/home/frame1.webp'),
            asset('images/home/frame2.webp'),
            asset('images/home/frame3.webp'),
        ];

        $cardsFor = fn (string $title): array => array_map(
            fn (string $image): array => ['name' => $title, 'image' => $image],
            $cardImages,
        );

        $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. 

Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.';

        $this->categorias = [
            'todo-incluido' => [
                'title' => 'Todo incluido',
                'text'  => $lorem,
                'cards' => $cardsFor('Todo incluido'),
            ],
            'plan-europeo' => [
                'title' => 'Plan Europeo',
                'text'  => $lorem,
                'cards' => $cardsFor('Plan Europeo'),
            ],
            'glamping' => [
                'title' => 'Glamping',
                'text'  => $lorem,
                'cards' => $cardsFor('Glamping'),
            ],
            'cruceros' => [
                'title' => 'Cruceros',
                'text'  => $lorem,
                'cards' => $cardsFor('Cruceros'),
            ],
            'long-stay' => [
                'title' => 'Long Stay',
                'text'  => $lorem,
                'cards' => $cardsFor('Long Stay'),
            ],
        ];
    }

    public function render(): View
    {
        return view('components.home-filter-details');
    }
}
