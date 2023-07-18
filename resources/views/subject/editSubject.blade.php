
<h2>Edit Subject</h2>
<form>
    @csrf
    <div class="mb-3">
    <label for="nameInput" class="form-label">Name</label>
    <input type="text" class="form-control info" name="Name" id="nameInput" placeholder="Input Name">
    </div>

    <div class="mb-3">
    <label for="descriptionInput" class="form-label">Description</label>
    <textarea class="form-control info" id="descriptionInput" name="Des" rows="5" placeholder="Input Description"></textarea>
    </div>

    <button class="btn btn-info btn-edit" id="btn-edit">Edit</button>
    <button class="btn btn-danger btn-cancel" id="btn-cancel">Cancel</button>   
</form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       var id = -1;
        $(document).ready(function() {
            id = {{$id}}
            console.log(id);
            $.ajax({
            url: `http://127.0.0.1:8000/api/edit/showSubject/${(id)}`,
            type: 'GET',
            accepts: {
            mycustomtype: 'application/x-some-custom-type'
                },
                success: function(response) {
                $('#nameInput').val(response.subject.name)
                $('#descriptionInput').text(response.subject.description)
                }
            })

            $('.btn-cancel').on('click', function(e) {
            e.preventDefault();
            // var url = 'http://127.0.0.1:8000/api/cancelSubject';
            // $.ajax({
            //     url: url,
            //     type: 'GET',
            //     dataType: 'html',
            //     success: function(response) {
            //         // Xử lý kết quả AJAX ở đây (ví dụ: hiển thị form add)
            //         $('.subjectRender').html(response);
            //         }
            //     });
            window.location.href="/subjects";
            });
            $('.btn-edit').on('click', function(e) {
            e.preventDefault();
            var url = `http://127.0.0.1:8000/api/edit-subject/${(id)}`;
           
            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                        name: $('#nameInput').val(),
                        description: $('#descriptionInput').val()
                    },
                success: function(response) {
                    console.log("xong roi");
                    //Sua xong quay ve
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