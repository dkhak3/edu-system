
<title>Update subject</title>

<div class="loader-sub"></div>
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Update subject
            </h1>
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
      
        <button id="btn-edit" class="btn-primary-style btn-submit form-submit">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Update subject
        </button>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       var id = -1;
        $(document).ready(function() {
            id = {{$id}}
            console.log(id);
            $('.loader-sub').attr('class', 'loader-subject');
            $.ajax({
            url: `http://127.0.0.1:8000/api/edit/showSubject/${(id)}`,
            type: 'GET',
            accepts: {
                    mycustomtype: 'application/x-some-custom-type'
                },
                success: function(response) {
                $('.loader-subject').css('display', 'none');
                $('#nameInput').val(response.subject.name)
                $('#descriptionInput').text(response.subject.description)
                }
            })

            // $('.btn-cancel').on('click', function(e) {
            // e.preventDefault();
            // // var url = 'http://127.0.0.1:8000/api/cancelSubject';
            // // $.ajax({
            // //     url: url,
            // //     type: 'GET',
            // //     dataType: 'html',
            // //     success: function(response) {
            // //         // Xử lý kết quả AJAX ở đây (ví dụ: hiển thị form add)
            // //         $('.subjectRender').html(response);
            // //         }
            // //     });
            // window.location.href="/subjects";
            // });
            $('#btn-edit').on('click', function(e) {
            e.preventDefault();
            var url = `http://127.0.0.1:8000/api/edit-subject/${(id)}`;
            $('.loader-subject').css('display', 'flex');
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                        name: $('#nameInput').val(),
                        description: $('#descriptionInput').val()
                    },
                success: function(response) {
                    // Sua xong quay ve
                    $('.loader-subject').css('display', 'none');
                    var urlz = 'http://127.0.0.1:8000/api/indexSubject';
                        $.ajax({
                            url: urlz,
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