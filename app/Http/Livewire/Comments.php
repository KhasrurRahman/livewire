<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{

    use WithPagination;
    use WithFileUploads;


    public $newcomment;
    public $image;

    protected $rules = [
        'newcomment' => 'required|max:255',
        'image' => 'required|image|max:1024',
    ];

    public function updated()
    {
        $this->validate();
    }


    public function all_comments()
    {
        return Comment::latest()->get();
    }

    public function delete_comment($commentID)
    {
        Comment::find($commentID)->delete();
        session()->flash('message', 'Comment Deleted successfully.');
    }

    public function addcomment()
    {
        $this->validate();
        $create_comment = Comment::create(['body' => $this->newcomment, 'user_id' => 1]);
        $this->newcomment = '';
        session()->flash('message', 'Comment added successfully.');
    }


    public function render()
    {
        return view('livewire.comments',
        [
            'comments' => Comment::latest()->paginate(2)
        ]
    );
    }
}
