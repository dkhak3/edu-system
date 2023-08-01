<title>Add New Lecturers</title>

{{-- New Lecturers --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class>
            <h1 class="dashboard-heading">
                New Lecturers
            </h1>
            <p class="dashboard-short-desc">Add your lecturer</p>
        </div>
    </div>

    {{-- Form --}}
    <form method="POST" class="form-main" id="form-1">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name" name="name"
                            id="name" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address" name="address"
                            id="address" class="form-control">
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
                        <input type="text" placeholder="Enter your phone" name="phone"
                            id="phone" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday" name="birthday"
                            id="birthday" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary-style btn-submit form-submit"
            id="btnAddLecturer">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Add new lecturer
        </button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="{{ asset ('/js/toast.js') }}"></script>
<script src="{{ asset ('/js/validate_form_lecturer.js') }}"></script>

{{-- Add --}}
<script>
    Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#name'),
            Validator.isRequired('#address'),
            Validator.isRequired('#phone'),
            Validator.isRequired('#birthday'),
            Validator.isName('#name'),
            Validator.isPhone('#phone'),
            Validator.isBirthday('#birthday'),
            Validator.maxLength('#name', 191),
            Validator.maxLength('#address', 191),
            Validator.maxLength('#phone', 191),
        ],
    });


    $(document).ready(function() {
        // Add lecturer
        $(document).on('click','#btnAddLecturer', function(e) {
            e.preventDefault();

            var data = {
                'name' : $('#name').val(),
                'address' : $('#address').val(),
                'phone' : $('#phone').val(),
                'birthday' : $('#birthday').val(),
                
            }
            if (data.name && data.address && data.phone && data.birthday) {
                displayLoader();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: 'lecturers',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    showSuccessToast("You have successfully added lecturer.");
                    refreshForm();
                    removeLoader();
                },
                error: function(res) {
                    showErrorToast("Can not add new lecturer.");
                    removeLoader();
                }
            });
        });
    }); 

    function refreshForm() {
        $('#name').val("");
        $('#address').val("");
        $('#phone').val("");
        $('#birthday').val("");
    }

    function displayLoader() {
        $('.spinner').addClass("spinner-border mx-auto");
        $('.btn-submit').addClass("opacity-25");
        $('.btn-submit').prop('disabled', true)
    }

    function removeLoader() {
        $('.spinner').removeClass("spinner-border mx-auto");
        $('.btn-submit').removeClass("opacity-25");
        $('.btn-submit').prop('disabled', false)
    }
</script>
