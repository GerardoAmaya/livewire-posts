<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;	

use Illuminate\Support\Facades\Storage;

class EditPost extends Component
{

    use WithFileUploads;

    //propiedad publica para abrir y cerrar el modal
    public $open = false;
    //propiedad post para recibir el post que se va a editar 
    public $post, $image, $identificador;

    //propiedad protected para las reglas de validacion, se le asigna un array con las reglas de validacion
    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];




    //metodo mount para recibir el post que se va a editar
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->identificador = rand();

    }

    //metodo save para guardar los cambios en la base de datos
    public function save()
    {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);

            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open', 'image']);

        $this->identificador = rand();

        $this->emitTo('show-posts', 'render');

        $this->emit('alert', 'El post se actualizó satisfactoriamente');

    }

    //metodo updated para validar los campos del formulario en tiempo real
    public function render()
    {
        return view('livewire.edit-post');
    }
}
