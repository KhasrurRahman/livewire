<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Comments extends Component
{

    public $comments;
    public $newcomment = "";

    protected $rules = [
        'newcomment' => 'required|max:255',
    ];

    public function updated()
    {
        $this->validate();
    }

    public function mount()
    {
        $this->comments = Comment::all();
    }

    public function all_comments()
    {
        return Comment::latest()->get();
    }

    public function delete_comment($commentID)
    {
        Comment::find($commentID)->delete();
        $this->comments = $this->comments->where('id', '!==', $commentID);
    }


    public function addcomment()
    {
        $this->validate();
        $create_comment = Comment::create(['body' => $this->newcomment, 'user_id' => 1]);

        $this->comments->prepend($create_comment);

        $this->newcomment = '';
    }


    public function render()
    {
        return view('livewire.comments');
    }
}
