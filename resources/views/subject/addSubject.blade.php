
<title>Add subject</title>

<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Add subject
            </h1>
            <p class="dashboard-short-desc">Add your new subject</p>
        </div>
    </div>

    {{-- Form --}}
    <div autocomplete="off" class="form-main">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="nameInput">Name</label>
                    <div>
                        <input type="text" name="nameInput" id="nameInput" class="form-control" placeholder="Enter your name...">
                    </div>
                    {{-- @if ($errors->has('lecturer_name'))
                    <span class="text-danger">{{ $errors->first('lecturer_name') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="descriptionInput">Description</label>
                    <div>
                        <textarea class="form-control info" id="descriptionInput" name="Des" rows="5" placeholder="Input Description"></textarea>
                       
                    </div>
                    {{-- @if ($errors->has('lecturer_address'))
                    <span class="text-danger">{{ $errors->first('lecturer_address') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
        </div>
      
        <button id="btn-add" class="btn-primary-style btn-submit form-submit">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Update subject
        </button>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       
        $(document).ready(function() {
            $('#btn-add').on('click', function(e) {
                e.preventDefault();
                var url = 'http://127.0.0.1:8000/api/add-subjects';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                            name: $('#nameInput').val(),
                            description: $('#descriptionInput').val()
                        },
                    success: function(response) {
                        console.log("Them thanh cong");
                            $.ajax({
                                url: 'http://127.0.0.1:8000/api/indexSubject',
                                type: 'GET',
                                dataType: 'html',
                                success: function(response) {
                                    // Xử lý kết quả AJAX ở đây (ví dụ: hiển thị form add)
                                    $('.subjectRender').html(response);
                                    }
                            });
                        }
                    });
            });
        });

    </script>