@extends('layout')
<title>Add New Lecturers</title>

@section('content')
    
{{-- New Lecturers --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                New Lecturer
            </h1>
            <p class="dashboard-short-desc">Add your lecturer</p>
        </div>
    </div>
    
    {{-- Form --}}
    <form action="{{ route('store') }}" method="POST" class="form-main" id="form-1">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name" name="name" id="name" class="form-control" >
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address" name="address" id="address" class="form-control" >
                    </div>
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                    <span class="form-message"></span>
                </div>
            </div>
        </div>
        {{-- Phone, Birthday --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="phone">Phone</label>
                    <div>
                        <input type="text" placeholder="Enter your phone" name="phone" id="phone" class="form-control" >
                    </div>
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday" name="birthday" id="birthday" class="form-control" >
                    </div>
                    @if ($errors->has('birthday'))
                        <span class="text-danger">{{ $errors->first('birthday') }}</span>
                    @endif
                    <span class="form-message"></span>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mx-auto gap-3">
            <button type="submit" class="btn-primary-style-2 btn-submit form-submit">
                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                Add new lecturer
            </button>
            <a href="/lecturers" class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById("lecturer").classList.add("active");
    document.getElementById("dashboard").classList.remove("active");

    const form = document.querySelector("form");
    form.addEventListener("submit", (e) => {
        displayLoader();
    })

    function displayLoader() {
        $('.btn-submit').prop('disabled', true)
        $('.spinner').addClass("spinner-border mx-auto");
        $('.btn-submit').addClass("opacity-25");
    }
</script>
@endsection