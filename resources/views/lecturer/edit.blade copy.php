{{-- Edit Lecturers --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Update Lecturers
            </h1>
            <p class="dashboard-short-desc">Update your lecturer id: <strong>{{ $item->id }}</strong></p>
        </div>
    </div>
    
    {{-- Form --}}
    <form class="form-main" id="form-1">
        @csrf
        @method('PUT')
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name" name="name" id="edit_name" class="form-control" value="{{ $item->name }}">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address" name="address" id="edit_address" class="form-control" value="{{ $item->address }}">
                    </div>
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
                        <input type="text" placeholder="Enter your phone" name="phone" id="edit_phone" class="form-control" value="{{ $item->phone }}">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday" name="birthday" id="edit_birthday" class="form-control" value="{{ $item->birthday }}">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary-style btn-submit form-submit" id="btnEditLecturer">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Update lecturer
        </button>
    </form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset ('/js/toast.js') }}"></script>
<script src="{{ asset ('/js/validate_form_lecturer.js') }}"></script>

<script>
    Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#edit_name'),
            Validator.isRequired('#edit_address'),
            Validator.isRequired('#edit_phone'),
            Validator.isRequired('#edit_birthday'),
            Validator.isName('#edit_name'),
            Validator.isPhone('#edit_phone'),
            Validator.isBirthday('#edit_birthday'),
            Validator.maxLength('#edit_name', 191),
            Validator.maxLength('#edit_address', 191),
            Validator.maxLength('#edit_phone', 191),
        ],
    });

    $(document).ready(function() {
        $('#btnEditLecturer').on('click', function(e) {
            e.preventDefault();

            var url = `http://127.0.0.1:8000/api/lecturers/edit-lecturer/`+{{$item->id}};
        
            var data = {
                'name': $('#edit_name').val(),
                'address': $('#edit_address').val(),
                'phone': $('#edit_phone').val(),
                'birthday': $('#edit_birthday').val(),
            }

            if ($('#edit_name').val() != "" && $('#edit_address').val() != "" 
                && $('#edit_phone').val() != "" && $('#edit_birthday').val() != "") {
                    addLoaderSpinner();
            }

            $.ajax({
                url: url,
                type: 'PUT',
                data: data,
                    success: function(response) {
                        showSuccessToast("Update lecturer successfully.");

                        removeLoaderSpinner();

                        window.location.href="/lecturers";
                    },
                    error: function(res) {
                        showErrorToast("Can not update lecturer.");
                        removeLoaderSpinner();
                    }
            });
        });
    });

    function addLoaderSpinner() {
        $('.spinner').addClass("spinner-border mx-auto");
        $('.btn-submit').addClass("opacity-25");
        $('.btn-submit').prop('disabled', true)
    }

    function removeLoaderSpinner() {
        $('.spinner').removeClass("spinner-border mx-auto");
        $('.btn-submit').removeClass("opacity-25");
        $('.btn-submit').prop('disabled', false)
    }

</script>