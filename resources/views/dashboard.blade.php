{{-- Este archivo sirve para mostrar el contenido de la vista del dashboard,
en este caso se muestra el componente show-posts que es el que muestra la tabla de los posts.  --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @livewire('show-posts', ['title' => 'Este es un titulo de prueba'])
            
        </div>
    </div>
</x-app-layout>
