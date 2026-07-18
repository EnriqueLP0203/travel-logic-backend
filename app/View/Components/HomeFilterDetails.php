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
        $this->categorias = [
            'hoteles' => [
                'title' => 'Hoteles',
                'text'  => 'Encuentra el hospedaje ideal para tus clientes con tarifas netas garantizadas en más de 500 hoteles en México, el Caribe y destinos internacionales.',
            ],
            'vuelos' => [
                'title' => 'Vuelos',
                'text'  => 'Reserva vuelos nacionales e internacionales con las mejores conexiones y precios competitivos para armar el viaje completo.',
            ],
            'paquetes' => [
                'title' => 'Paquetes',
                'text'  => 'Combina hotel, vuelo y traslados en un solo paquete listo para vender, con la flexibilidad de personalizarlo según cada cliente.',
            ],
            'tours' => [
                'title' => 'Tours',
                'text'  => 'Ofrece experiencias y actividades en destino: excursiones, tours guiados y aventuras que hacen memorable cada viaje.',
            ],
            'bodas' => [
                'title' => 'Grupos & Bodas',
                'text'  => 'Organiza bodas de destino y viajes en grupo con atención especializada, cotizaciones a la medida y coordinación de principio a fin.',
            ],
        ];
    }

    public function render(): View
    {
        return view('components.home-filter-details');
    }
}