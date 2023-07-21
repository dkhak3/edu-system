
<title>Add new subject</title>

{{-- New Lecturers --}}
<div class="dashboard-children active subjectRender">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Add New subject
            </h1>
            <p class="dashboard-short-desc">Add your new subject</p>
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
                        <input type="text" placeholder="Enter your name..." name="name" id="nameInput" class="form-control"
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
                    <label for="descriptionInput">Description</label>
                    <div>
                        <input type="text" placeholder="Enter your description..." name="descriptionInput" id="descriptionInput"
                            class="form-control">
                    </div>
                    {{-- @if ($errors->has('lecturer_address'))
                    <span class="text-danger">{{ $errors->first('lecturer_address') }}</span>
                    @endif --}}
                    <span class="form-message"></span>
                </div>
            </div>
        </div>
        

        

        <button type="button" id="btn-add" class="btn-primary-style btn-submit form-submit btn-add">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Add new subject
        </button>
    </form>
    {{-- <button type="button" id="btn-cancel" class="btn btn-danger btn-cancel">
        <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
        Cancel
    </button> --}}
</div>
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //Hàm Khởi Tạo 
        $(document).ready(function() {
            //Bắt sự kiện cho nút Cancel
            $('.btn-cancel').on('click', function(e) {
            // e.preventDefault();
            // var url = 'http://127.0.0.1:8000/api/cancelSubject';
            // $.ajax({
            //     url: url,
            //     type: 'GET',
            //     dataType: 'html',
            //     success: function(response) {
            //         // Xử lý kết quả AJAX ở đây (ví dụ: hiển thị form add)
            //         $('body').html(response);
            //         }
            //     });
            window.location.href="/subjects";
            });
             //Bắt sự kiện cho nút Add Subject
            $('.btn-add').on('click', function(e) {
            e.preventDefault();
            var url = 'http://127.0.0.1:8000/api/add-subjects';
           //Gửi request
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                        name: $('#nameInput').val(),
                        description: $('#descriptionInput').val()
                    },
                success: function(response) {
                    //Add xong quay về trang chủ
                    // var urlz = 'http://127.0.0.1:8000/api/cancelSubject';
                    //     $.ajax({
                    //         url: urlz,
                    //         type: 'GET',
                    //         dataType: 'html',
                    //         success: function(response) {
                    //             // Xử lý kết quả AJAX ở đây (ví dụ: hiển thị form add)
                    //             $('.subjectRender').html(response);
                    //             }
                    //     });
                    }
                });
            });
            
        });
    </script>