@extends('layout')
@section('content')
<title>Update subject</title>

<div class="loader-sub"></div>
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Update subject
            </h1>
            <p class="dashboard-short-desc">Update your subject</p>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('editSubject', ['id' => $subject->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="nameInput">Name</label>
                    <div>
                        <input type="text" name="nameInput" id="nameInput" class="form-control" value="{{ $subject->name }}" placeholder="Edit your name...">
                    </div>
                    @if ($errors->has('nameInput'))
                        <div class="alert alert-danger">
                            {{ $errors->first('nameInput') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="descriptionInput">Description</label>
                    <div>
                        <textarea class="form-control info" id="desInput" name="desInput" rows="5" placeholder="Edit Description">{{ $subject->description }}</textarea>
                    </div>
                    @if ($errors->has('desInput'))
                    <div class="alert alert-danger">
                        {{ $errors->first('desInput') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mx-auto gap-3">
            <button type="submit" id="btn-add" class="btn-primary-style-2  btn-submit form-submit ">
                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                Update Subject
            </button>
            <button id="btn-cancel" class="btn-cancel">
                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                Cancel
            </button>
        </div>  
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
        $('#subject-page').addClass('active');
        $('#dashboard').removeClass('active');
        $('#dashboard-content').addClass('d-none');

        $('#btn-cancel').on('click', function(e){
            e.preventDefault();
            var goBack = "{{ route('subject') }}";
            // Thêm từ khóa vào URL và chuyển hướng đến route "subjects.search"
            window.location.href = goBack;
        })
</script>
@endsection