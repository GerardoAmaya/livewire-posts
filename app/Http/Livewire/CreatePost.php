<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    //importamos la clase WithFileUploads para poder subir archivos
    use WithFileUploads;
    public $open = false;

    //propiedades publicas para los campos del formulario
    public $title, $content, $image, $identificador;
    //metodo mount para generar un identificador unico para cada formulario
    public function mount()
    {
        $this->identificador = rand();
    }

    //propiedad protected para las reglas de validacion, se le asigna un array con las reglas de validacion 
    //y se le asigna el nombre de la propiedad que se quiere validar
    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];


    // public function updated($propertyName)
    // {
    //     //validamos los campos del formulario con el metodo validate() para que se ejecute en tiempo real
    //     $this->validateOnly($propertyName);
    // }

    //Metodo save
    public function save()
    {
        //validamos los campos del formulario con el metodo validate() para que luego ejecute el post a la base de datos
        $this->validate();

        //guardamos la imagen en la carpeta public/storage usando el metodo store() y le pasamos como parametro la carpeta donde se va a guardar
        $image = $this->image->store('posts');

        //guardamos los datos en la base de datos
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);
        // emitiendo eventos 
        // reseteamos las propiedades del componente para que se limpien los campos del formulario
        $this->reset(['open', 'title', 'content', 'image']);

        $this->identificador = rand();

        //utilizamos el metodo emit() para emitir un evento y el metodo emiTo() para emitir un evento a un componente especifico 
        $this->emitTo('show-posts', 'render');

        $this->emit('alert', 'El post se creó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
