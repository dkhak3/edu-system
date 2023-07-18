@extends("layout")
@section('content')
    <div class="Title" id="tableSubject">
        <div class="col">
            <div class="col-md-4 mx-auto">
                <h2>Subjects</h2> 
            </div>
            
            <div class="col-md-4 ms-auto">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 input-search" type="search" placeholder="Search" aria-label="Search">
                    {{-- <button class="btn btn-outline-success" type="submit">Search</button> --}}
                  </form>
            </div>
            <div class="col-md-4">
                <button class="link-to-add btn btn-success">Add Subject</button>
                <button class="link-to-delete btn btn-danger">Delete Selected</button>
            </div>
        </div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkAll">
                    <label class="form-check-label" for="checkAll">
                        Check&nbsp;All
                    </label>
            </div>
            </th>
            <th scope="col">Name <button class="btn-a-z" id="a-z"><i class="fa-solid fa-arrow-down-a-z"></i></button>
                <button class="btn-z-a" id="z-a"><i class="fa-solid fa-arrow-down-z-a"></i></button>
            </th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tbSubject"></tbody>
        </tbody>
      </table>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //Khởi tạo sự kiện trước khi load
        $(document).ready(function() {
            //Bắt sự kiện cho btn-add
        $('.link-to-add').on('click', function(e) {
            
            var url = 'http://127.0.0.1:8000/api/addSubject';
            var self = this; 
            $(self.container).html('<div id="loader" class="loader"></div>');
            $.ajax({
                url: 'http://127.0.0.1:8000/api/addSubject',
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    console.log(response);
                    $('.subjectRender').html(response);
                }
            });
        });
        });

        var subject = {
            list: null,
        };
        // var sortA = 'increaseName';
        // var sortB = 'reduceName';
        $(function() {
            subject.list = new DataList();
            subject.list.load();
        });
       
      
        //Class danh sách dữ liệu
        var DataList  = class{
            constructor() {
                this.url = 'http://127.0.0.1:8000/api/getAllSubject';
                this.urlz = 'http://127.0.0.1:8000/api/getAllSubjectZA';
                this.urlsearch = 'http://127.0.0.1:8000/api/getSearchSubject';
                this.container = "#tbSubject";
            }
            
            //Hàm hiển thị danh sách
            load() {
                console.log("a-z");
                $("#z-a").hide();
                var self = this; 
                $(self.container).html('<div id="loader" class="loader"></div>');
                $.ajax({
                        url: this.url,
                        type: 'GET',
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                        $("#loader").hide();
                        },
                        
                    })
                    .done(function(result) {
                        //Sau khi lấy danh sach -> render ra table
                        $(self.container).html(
                            result.subjects.map(e => {
                                return `<tr>
                                <td><input class="form-check-input toCheck" type="checkbox" data-item="${e.id}"></td>
                                <td>${e.name}</td>
                                <td>${e.description}</td>
                                <td>
                                <button data-item="${e.id}" class="btn btn-delete btn-danger">
                                    Delete
                                </button>
                                <button data-item="${e.id}" class="btn btn-edit btn-info">
                                    Update
                                </button>
                                </td>
                            </tr>`;
                            }).join('')
                        );
                        // Gọi phương thức AfterLoadEvent để gắn sự kiện sau khi load
                        self.AfterLoadEvent(); 
                        
                    });
            }
            //Hàm xóa Subject
            DeleteSubject(element) {
                var self = this;
                $.ajax({
                    url: `http://127.0.0.1:8000/api/deleteSubject/${$(element).attr("data-item")}`,
                    type: 'DELETE',
                    dataType: 'html',
                    accepts: {
                        mycustomtype: 'application/x-some-custom-type'
                    },
                    success: function(response) {
                        self.load() 
                        //Load lại sau khi xóa
                    }
                })

            }
          
            loadz() {
                var self = this; 
                $(self.container).html('<div id="loader" class="loader"></div>');
                $.ajax({
                        url: this.urlz,
                        type: 'GET',
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                        $("#loader").hide();
                        },
                        
                    })
                    .done(function(result) {
                        //Sau khi lấy danh sach -> render ra table
                        $(self.container).html(
                            result.subjects.map(e => {
                                return `<tr>
                                <td><input class="form-check-input toCheck" type="checkbox" data-item="${e.id}"></td>
                                <td>${e.name}</td>
                                <td>${e.description}</td>
                                <td>
                                <button data-item="${e.id}" class="btn btn-delete btn-danger">
                                    Delete
                                </button>
                                <button data-item="${e.id}" class="btn btn-edit btn-info">
                                    Update
                                </button>
                                </td>
                            </tr>`;
                            }).join('')
                        );
                        // Gọi phương thức AfterLoadEvent để gắn sự kiện sau khi load
                        self.AfterLoadEvent(); 
                    });
            }
            
            loadsearch(key) {
                var self = this; 
                $(self.container).html('<div id="loader" class="loader"></div>');
                $.ajax({
                    url: this.urlsearch,
                    type: 'GET',
                    data: { key: key }, // Truyền giá trị key
                    dataType: 'json',
                    success: function(response) {
                        // Xử lý phản hồi thành công từ server
                        console.log(response.subjects);
                        $("#loader").hide();
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi khi yêu cầu không thành công
                        console.log(error);
                    },  
                })
                .done(function(result) {
                        //Sau khi lấy danh sach -> render ra table
                        $(self.container).html(
                            result.subjects.map(e => {
                                return `<tr>
                                <td><input class="form-check-input toCheck" type="checkbox" data-item="${e.id}"></td>
                                <td>${e.name}</td>
                                <td>${e.description}</td>
                                <td>
                                <button data-item="${e.id}" class="btn btn-delete btn-danger">
                                    Delete
                                </button>
                                <button data-item="${e.id}" class="btn btn-edit btn-info">
                                    Update
                                </button>
                                </td>
                            </tr>`;
                            }).join('')
                        );
                        // Gọi phương thức AfterLoadEvent để gắn sự kiện sau khi load
                        self.AfterLoadEvent(); 
                });
            }
            //Hàm Sự kiện sau khi load
            AfterLoadEvent() {
                var self = this; // Lưu trữ tham chiếu đến đối tượng DataList
                $('.btn-delete').each(function(index, element) {
                    //Gọi hàm DeleteSubject và xóa theo id
                    $(element).click(function() {
                        self.DeleteSubject(element);
                    });
                });
                var number = -1;
                $('.btn-edit').each(function(index, element) {
                    //Trả về trang edit + id của element
                    $(element).click(function() {
                        $(self.container).html('<div id="loader" class="loader"></div>');
                        number = $(element).attr('data-item');
                        var url = `http://127.0.0.1:8000/api/editSubject/${(number)}`;
                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'html',
                            success: function(response) {
                                $('.subjectRender').html(response);
                            }
                        });
                    }); 
                });
                $('.btn-a-z').on('click', function(e) {  
                    $("#a-z").hide();
                    $("#z-a").show();
                    self.loadz();
                    
                });
                $('.btn-z-a').on('click', function(e) {
                    $("#a-z").show();
                    $("#z-a").hide();
                    self.load();
                });
                $('.input-search').each(function(index, element) {
                    $(element).on('keyup', function() {
                        $(self.container).html('<div id="loader" class="loader"></div>');
                        setTimeout(() => {
                            // Xử lý logic khi xảy ra sự kiện keyup
                        var value = $(this).val();
                        if(value==''){
                            console.log("getall");
                            self.load();
                        }
                        else{
                            // console.log('Input value:', value);
                            self.loadsearch(value);
                        }
                        // Các xử lý khác...
                        }, 2000);
                    });
                });
            }
        }
    </script>
@endsection