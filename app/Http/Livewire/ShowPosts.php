<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
// COMPONENTE para mostrar los post
class ShowPosts extends Component
{
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    // propiedad para escuchar el evento render que se emite desde el componente CreatePost 
    protected $listeners = ['render'];


    // Propiedad para el post, render() es el METODO que se ejecuta cuando se llama al componente en la vista 
    // y se le pasa la propiedad posts que es un array de objetos Post que se obtienen de la base de datos con el método all()
    public function render()
    {
        $posts = Post::where('title', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('content', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->get();
        return view('livewire.show-posts', compact('posts'));
    }

    // METODO para ordenar los post
    //la funcion order() recibe el parametro $sort que es el nombre de la columna por la que se quiere ordenar los post 
    //y se le asigna a la propiedad $sort del componente y se le asigna el valor 'desc' a la propiedad $direction 
    //del componente si el valor de la propiedad $sort es igual al valor del parametro $sort que se le pasa a la funcion order()  

    public function order($sort)
    {   
        // el if lo que hace es que si el valor de la propiedad $sort es igual al valor del parametro 
        //$sort que se le pasa a la funcion order() entonces se le asigna el valor 'asc' a la propiedad $direction 
        //del componente y si no es igual entonces se le asigna el valor 'desc' a la propiedad $direction del componente
        // y se le asigna el valor del parametro $sort que se le pasa a la funcion order() a la propiedad $sort del componente
        if ($this->sort = $sort) {
        
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        // y si el valor de la propiedad $sort es diferente al valor del parametro $sort que se le pasa a la funcion order() 
        // entonces se le asigna el valor del parametro $sort que se le pasa a la funcion order() a la propiedad $sort del componente
        // y se le asigna el valor 'desc' a la propiedad $direction del componente 
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        


        // if($this->sort == $sort){
        //     if($this->direction == 'desc'){
        //         $this->direction = 'asc';
        //     }else{
        //         $this->direction = 'desc';
        //     }
        // }else{
        //     $this->sort = $sort;
        //     $this->direction = 'desc';
        // }
    }
}
