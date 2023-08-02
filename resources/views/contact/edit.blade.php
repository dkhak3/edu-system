<title>Update contact</title>
@extends('layout')
@section('content')

<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Update contact
            </h1>
            <p class="dashboard-short-desc">Update your contact id: <strong>{{ $item->id }}</strong></p>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('contacts.update', $item->id) }}" method="POST" class="form-main">
        @csrf
        @method('PUT')
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}"
                            placeholder="Enter your name...">
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
                        <input type="text" name="address" id="address" class="form-control" value="{{ $item->address }}"
                            placeholder="Enter your address...">
                        @if ($errors->has('lecturer_address'))
                        <span class="text-danger">{{ $errors->first('lecturer_address') }}</span>
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
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $item->phone }}"
                            placeholder="Enter your phone...">
                        @if ($errors->has('lecturer_phone'))
                        <span class="text-danger">{{ $errors->first('lecturer_phone') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" name="birthday" id="birthday" class="form-control"
                            value="{{ $item->birthday }}" placeholder="Enter your birthday...">
                        @if ($errors->has('lecturer_birthday'))
                        <span class="text-danger">{{ $errors->first('lecturer_birthday') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center mx-auto gap-3">
            <button type="submit" id="btn_submit" class="btn-primary-style-2 btn-submit form-submit">
                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                Update contact
            </button>
            <a href="{{ url('contacts') }}" class="btn-cancel">Cancel</a>
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
        $('form').append('<div class="load d-block text-center mx-auto"></div>');
        for (let i = 0; i < 3; i++) {
            $('.load').append('<div class="spinner-grow text-info ms-1"></div>');
        }
    }
</script>

@endsection

{{-- <script>
    $('form').submit(function (e){
        e.preventDefault();
        if (checkFormInput()) {
            addLoaderSpinner();
            var data = {
                'name' : $('#name').val(),
                'address' : $('#address').val(),
                'phone' : $('#phone').val(),
                'birthday' : $('#birthday').val(),
            }

            $.ajax({
                url: 'contacts/update/'+ {{ $item->id }},
                type: 'PUT',
                data: data,
                dataType: 'html',
                success: function(response) {
                    removeLoaderSpinner();
                    showSuccessToast(response.message);
                    loadIndex();
                }
            });
        }
    });

    function addLoaderSpinner() {
        $('#btn_submit_edit_contact').addClass('d-none');
        $('form').append('<div class="load d-block text-center mx-auto"></div>');
        for (let i = 0; i < 3; i++) {
            $('.load').append('<div class="spinner-grow text-info ms-1"></div>');
        }
    }

    function removeLoaderSpinner() {
        $('.load').remove();
        $('#btn_submit_edit_contact').removeClass('d-none');
    }

    function loadIndex() {
        $.ajax({
            url: 'contacts',
            type: "GET",
            success: function (response) {
                console.log(response);
                $('body').html(response);
                
            },
        })
    }

</script> --}}