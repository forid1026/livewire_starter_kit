<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Flux\Flux;

class PostEdit extends Component
{
    public $title, $description, $postId;
    public function render()
    {
        return view('livewire.post-edit');
    }

    #[On('editPost')]
    public  function editPost($post)
    {
        
        $post = Post::find($post);

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;

        Flux::modal('edit-post')->show();

    }

    public function updatePost()
    {
        $post = Post::find($this->postId);

        $post->update([
            'title' => $this->title,
            'description' => $this->description,
            'updated_at' => now()
        ]);

        Flux::toast('Post updated successfully.');
        Flux::modal('edit-post')->close();

        $this->dispatch('refreshPosts')->to('posts');

    }

}
