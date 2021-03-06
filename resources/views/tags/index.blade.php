@extends('layouts.app');

@section('content')
<div class="d-flex justify-content-end align-items-center mb-3">
    <a href="{{route('tags.create')}}" class="btn btn-warning">Add</a>
</div>
<div class="card card-default">
    <div class="card-header">
        All Tags
    </div>
    <div class="card-body">
        @if(sizeOf($tags))
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="w-50">
                    <span class="font-weight-bold">Tag Name</span>
                </div>
                <div class="w-25">
                    <span class="font-weight-bold">Number of Posts</span>
                </div>
                <div class="w-25 d-flex justify-content-end align-items-center">
                    <span class="font-weight-bold">. . .</span>
                </div>
            </li>
            @foreach($tags as $tag)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="w-50">
                    <span>{{ $tag->name }}</span>
                </div>
                <div class="w-25">
                    {{ $tag->posts->count() }}
                </div>
                <div class="w-25 d-flex justify-content-end align-items-center">
                    <a href="{{route('tags.edit', $tag->id )}}" class="text-primary mr-2" title="Edit tag"><i class="fa fa-pencil-square-o"></i></a>
                    <a type="button" class="text-danger" title="Delete todo" onclick="handleDeletClicked({{$tag->id}})"><i class="fa fa-trash"></i></a>
                </div>
            </li>

            @endforeach
        </ul>
        @else
        <div>
            <p class="text-center font-weight-bold">No Tag Available</p>
        </div>
        @endif

    </div>
</div>

<div class="modal fade" id="tagConfirmation" tabindex="-1" role="dialog" aria-labelledby="tagConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteTagForm">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tagConfirmationLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center font-weight-bold">Are you sure you want to delete this tag?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Yes Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleDeletClicked(id) {
        var form = document.getElementById('deleteTagForm');
        form.action = '/tags/' + id
        $('#tagConfirmation').modal('show')
    }
</script>
@endsection
