
    <h2>Add Subject</h2>
    <form >
        @csrf
        <div class="mb-3">
        <label for="nameInput" class="form-label">Name</label>
        <input type="text" class="form-control info" name="Name" id="nameInput" placeholder="Input Name">
        <span class="validate"></span>
        </div>

        <div class="mb-3">
        <label for="descriptionInput" class="form-label">Description</label>
        <textarea class="form-control info" id="descriptionInput" name="Des" rows="5" placeholder="Input Description"></textarea>
        <span class="validate"></span>
        </div>

        <button class="btn btn-success btn-add" id="btn-add">Add</button>
        <button class="btn btn-danger btn-cancel" id="btn-cancel">Cancel</button>   
    </form>  
    {{-- <div class="div">
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
    </div> --}}
{{-- 
    <div class="success-form">
        <div class="message">
            <div class="title mt-5">
                <i class="fa-solid fa-check"></i>

            </div>
            <div class="content-succsess">
                <div class="title">
                    Success
                </div>
                <div class="decription-sc mb-3">
                    Add course successfully!
                </div>
            </div>
            <div class="mb-5">
                <button class="btn s-okay btn-primary">OKAY</button>
                <button class="btn s-ctn btn-primary mr-3">Tiếp Tục</button>
            </div>
        </div>
    </div> --}}


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