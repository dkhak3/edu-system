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
    <form id="form" method="POST" enctype="multipart/form-data" class="form-main">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name..." name="name" id="name" class="form-control"
                            autofocus>
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
                    </div>
                    {{-- @if ($errors->has('lecturer_birthday'))
                    <span class="text-danger">{{ $errors->first('lecturer_birthday') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
        </div>

        <button type="button" id="btn_submit_add_contact" class="btn-primary-style btn-submit form-submit">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Add new contact
        </button>
    </form>
</div>

{{-- <script src="{{ asset ('/js/formadd_edit.js') }}"></script> --}}

<script>
    // Change menu item active
    document.getElementById("menuItem_contact").classList.add("active");
    document.getElementById("dashboard").classList.remove("active");

    $(document).on('click', '#btn_submit_add_contact', function (e) {
        e.preventDefault();

        var data = {
            'name' : $('#name').val(),
            'address' : $('#address').val(),
            'phone' : $('#phone').val(),
            'birthday' : $('#birthday').val(),
            
        }

        $.ajax({
            url: 'http://127.0.0.1:8000/api/contacts/store',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                showSuccessToast(response.message);
                // Delete values of form
                $('#name').val('');
                $('#address').val('');
                $('#phone').val('');
                $('#birthday').val('');
            }
        });
    });

    // Toast
    function toast({ 
        title = "", 
        message = "", 
        type = "info", 
        duration = 3000 
    }) {  
        const main = document.getElementById("toast");
        if (main) {
        const toast = document.createElement("div");
        
        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, duration + 1000);
    
        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast__close")) {
            main.removeChild(toast);
            clearTimeout(autoRemoveId);
            }
        };
        
        //icon
        const icons = {
            success: "fas fa-check-circle",
            error: "fas fa-exclamation-circle"
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
    
        toast.classList.add("toast", `toast--${type}`);
        toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;
    
        toast.innerHTML = `
                        <div class="toast__icon">
                            <i class="${icon}"></i>
                        </div>
                        <div class="toast__body">
                            <h3 class="toast__title">${title}</h3>
                            <p class="toast__msg">${message}</p>
                        </div>
                        <div class="toast__close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
        }
        }
        // Hiển thị
        function showSuccessToast(message) {
            toast({
                title: "Successfully!",
                message: message,
                type: "success",
                duration: 5000
            });
        }
        function showErrorToast(message) {
            toast({
                title: "Error!",
                message: message,
                type: "error",
                duration: 5000
            });
        }
</script>