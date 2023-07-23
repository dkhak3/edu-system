<title>Add new contact</title>

{{-- New Lecturers --}}
<div class="dashboard-children active subjectRender">
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
    <form id="form" class="form-main" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name..." name="name" id="name" class="form-control"
                            autofocus>
                        <div class="valid-feedback">Valid data.</div>
                        <div class="invalid-feedback">Invalid data.</div>
                    </div>
                    {{-- @if ($errors->has('lecturer_name'))
                    <span class="text-danger">{{ $errors->first('lecturer_name') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address..." name="address" id="address"
                            class="form-control">
                        <div class="valid-feedback">Valid data.</div>
                        <div class="invalid-feedback">Invalid data.</div>
                    </div>
                    {{-- @if ($errors->has('lecturer_address'))
                    <span class="text-danger">{{ $errors->first('lecturer_address') }}</span>
                    @endif --}}
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
                        <input type="text" placeholder="Enter your phone..." name="phone" id="phone"
                            class="form-control">
                        <div class="valid-feedback">Valid data.</div>
                        <div class="invalid-feedback">Invalid data.</div>
                    </div>
                    {{-- @if ($errors->has('lecturer_phone'))
                    <span class="text-danger">{{ $errors->first('lecturer_phone') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday..." name="birthday" id="birthday"
                            class="form-control">
                        <div class="valid-feedback">Valid data.</div>
                        <div class="invalid-feedback">Invalid data.</div>
                    </div>
                    {{-- @if ($errors->has('lecturer_birthday'))
                    <span class="text-danger">{{ $errors->first('lecturer_birthday') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
        </div>
        <button type="submit" id="btn_submit_add_contact" class="btn-primary-style btn-submit form-submit">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Add new contact
        </button>
    </form>
</div>

<script src="{{ asset ('/js/validate_form.js') }}"></script>
<script src="{{ asset ('/js/toast.js') }}"></script>

<script>
    $('form').submit(function (e) {
        e.preventDefault();
        if (checkFormInput()) {
            displayLoader();
            
            var data = {
                _token: "{{ csrf_token() }}",
                'name' : $('#name').val(),
                'address' : $('#address').val(),
                'phone' : $('#phone').val(),
                'birthday' : $('#birthday').val(),
            }
            
            $.ajax({
                url: 'contacts/store',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    removeLoader();
                    showSuccessToast(response.message);
                    refreshForm();
                }
            });
        }
        else {
            console.log('Sai input');
        }
        
    });

    function displayLoader() {
        $('#btn_submit_add_contact').addClass('d-none');
        $('form').append('<div class="load d-block text-center mx-auto"></div>');
        for (let i = 0; i < 3; i++) {
            $('.load').append('<div class="spinner-grow text-info ms-1"></div>');
        }
    }

    function removeLoader() {
        $('.load').remove();
        $('#btn_submit_add_contact').removeClass('d-none');
    }
    
</script>