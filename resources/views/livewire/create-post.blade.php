<div>

    {{-- button jetstream --}}
    <x-danger-button wire:click="$set('open', true)">
        Crear nuevo post
    </x-danger-button>

    {{-- Los eventos que emitamos los podemos escuchar dentro de un componente de livewire --}}
    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear nuevo post
        </x-slot>

        <x-slot name="content">
            <div wire:loading wire:target="image"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen cargando</strong>
                <span class="block sm:inline">Espere un momento...</span>
            </div>
            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}">
            @endif

            <div class="mb-4">
                <x-label value="Titulo del post" />
                <x-input type="text" class="w-full" wire:model="title" />

                <x-input-error for="title" />

                {{-- @error('title')

                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror --}}

                {{-- {{$title}} --}}
            </div>
            <div class="mb-4">
                <x-label value="Contenido del post" />

                <textarea wire:model.defer="content" class="form-control w-full" rows="6"></textarea>
                {{-- {{$content}} --}}
                <x-input-error for="content" />
                {{-- @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror --}}
            </div>

            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-input-error for="image" />
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="save" wire:loading.attr="disabled" wire:tarjet="save, image"
                class="disabled:opacity-25">
                Crear Post
            </x-danger-button>
            {{-- utilizamos wire loading para mostrar un mensaje de cargando mientras se ejecuta el metodo save 
                mandamos a llamar el metodo save que esta en el componente de livewire (le hacemos un tarjet al metodo save) --}}
            {{-- <span wire:loading wire:tarjet="save"> Cargando... </span> --}}
        </x-slot>

    </x-dialog-modal>

</div>
