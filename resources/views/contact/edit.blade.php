<title>Update contact</title>

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
    <form class="form-main">
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
                        <input type="text" name="address" id="address" class="form-control" value="{{ $item->address }}"
                            placeholder="Enter your address...">
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
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ $item->phone }}"
                            placeholder="Enter your phone...">
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
                        <input type="date" name="birthday" id="birthday" class="form-control"
                            value="{{ $item->birthday }}" placeholder="Enter your birthday...">
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

        <button type="submit" id="btn_submit_edit_contact" class="btn-primary-style btn-submit form-submit">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Update contact
        </button>
    </form>
</div>

<script src="{{ asset ('/js/validate_form.js') }}"></script>
<script src="{{ asset ('/js/toast.js') }}"></script>

<script>
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

</script>