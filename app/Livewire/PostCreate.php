<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Flux\Flux;

class PostCreate extends Component
{
    public $title = '';
    public $description = '';

    public function render()
    {
        return view('livewire.post-create');
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function createPost()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => now()
        ]);

        $this->reset(['title', 'description']);

        Flux::toast('Post created successfully.');
        Flux::modal('create-post')->close();

        $this->dispatch('refreshPosts')->to('posts');

    }
}
