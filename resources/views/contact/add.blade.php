<title>Add new contact</title>
@extends('layout')
@section('content')

{{-- New Contact --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Add New Contact
            </h1>
            <p class="dashboard-short-desc">Add your new contact</p>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('contacts.store') }}" class="form-main" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name..." name="name" id="name" class="form-control"
                            autofocus>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address..." name="address" id="address"
                            class="form-control">
                        @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Phone, Birthday --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="phone">Phone</label>
                    <div>
                        <input type="text" placeholder="Enter your phone..." name="phone" id="phone"
                            class="form-control">
                        @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday..." name="birthday" id="birthday"
                            class="form-control">
                        @if ($errors->has('birthday'))
                        <span class="text-danger">{{ $errors->first('birthday') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mx-auto gap-3">
            <button type="submit" id="btn_submit" class="btn-primary-style-2 btn-submit form-submit">
                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                Add new contact
            </button>
            <a href="{{ url('contacts') }}" id="btn_cancel" class="btn-cancel">Cancel</a>
        </div>

    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    // Change menu item active
    document.querySelector('#menuItem_contact').classList.add('active');

    $('form').submit(function(){
        displayLoader();
    });

    function displayLoader() {
        $('#btn_submit').addClass('d-none');
        $('#btn_cancel').addClass('d-none');
        $('form').append('<div class="load d-block text-center mx-auto"></div>');
        for (let i = 0; i < 3; i++) {
            $('.load').append('<div class="spinner-grow text-info ms-1"></div>');
        }
    }
</script>

@endsection