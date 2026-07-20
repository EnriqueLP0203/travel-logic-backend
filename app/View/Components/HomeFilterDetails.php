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
        $cards = [
            [
                'name'  => 'Hotel +',
                'image' => asset('images/home/frame1.webp'),
            ],
            [
                'name'  => 'Tour + Hotel',
                'image' => asset('images/home/frame2.webp'),
            ],
            [
                'name'  => 'Vuelo + Hotel',
                'image' => asset('images/home/frame3.webp'),
            ],
        ];

        $this->categorias = [
            'hoteles' => [
                'title' => 'Hoteles',
                'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. 

Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.',
                'cards' => $cards,
            ],
            'vuelos' => [
                'title' => 'Vuelos',
                'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. 

Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.',
                'cards' => $cards,
            ],
            'paquetes' => [
                'title' => 'Paquetes',
                'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. 

Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.',
                'cards' => $cards,
            ],
            'tours' => [
                'title' => 'Tours',
                'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. 

Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.',
                'cards' => $cards,
            ],
            'bodas' => [
                'title' => 'Grupos & Bodas',
                'text'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas dui magna, venenatis in gravida eget, dictum at lectus. Sed ex lectus, laoreet et felis at, ultricies mattis ex. Praesent eu auctor lacus. Nam ipsum lectus, accumsan sit amet nunc non, eleifend placerat orci. Fusce sed tempus nisl. 

Donec eget consectetur nisl. Aliquam fringilla sapien a dapibus vehicula. Vivamus cursus, elit porttitor aliquet scelerisque, justo nisi tincidunt tellus, vitae iaculis nulla enim eu sapien. Praesent venenatis quis augue et mattis. Sed interdum diam sit amet nunc volutpat, id vehicula tortor hendrerit. Curabitur vitae varius ante. Aliquam et nibh lectus.',
                'cards' => $cards,
            ],
        ];
    }

    public function render(): View
    {
        return view('components.home-filter-details');
    }
}
