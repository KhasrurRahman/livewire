<div class="row">
    <div class="card">
        <div class="card-body">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>



            <form wire:submit.prevent="addcomment">
                <div class="row">
                    <div class="col-md-10">
                        @error('newcomment')
                            <span class="error text-danger text-bold">{{ $message }}</span>
                        @enderror
                        {{ $image }}
                        <input type="file" class="form-control" wire:model="image">
                        <input class="form-control" type="text" value="Write Comment here..."
                            wire:model.debounce.500ms="newcomment">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary">Add Commment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-2" style="width: 100%">
        <ul class="list-group list-group-flush">
            @foreach ($comments as $comment)
                <button type="button" class="btn-close" aria-label="Close"
                    wire:click="delete_comment({{ $comment->id }})"></button>
                <li class="list-group-item">
                    <h3>{{ $comment->creator->name }}</h3>
                    <p>{{ $comment->body }}</p>
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
        <div style="height:100px">
            {{ $comments->links() }}
        </div>
    </div>
</div>
