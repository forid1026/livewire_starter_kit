<?php

namespace App\Livewire;

use App\Models\Post;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{
    public $posts, $postId;
    public function mount()
    {
        $this->posts = Post::latest()->get();
        
    }
    public function render()
    {
        return view('livewire.posts');
    }

    #[On('refreshPosts')]
    public function refreshPosts()
    {
        $this->posts = Post::latest()->get();
    }

    public function edit($id)
    {
        $this->dispatch('editPost', $id);
    }

    public function delete($id)
    {
        $this->postId = $id;
        Flux::modal('delete-post')->show();
    }

    public function deletePost()
    {
        Post::find($this->postId)->delete();
        Flux::modal('delete-post')->close();
        $this->dispatch('refreshPosts');
        Flux::toast('Post deleted successfully.');
    }
}
