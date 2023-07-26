
<title>Subjects</title>

<div class="loader-sub"></div>
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Subjects
            </h1>
            <p class="dashboard-short-desc">Manage your subject</p>
        </div>
        {{-- <a href="{{ route('add') }}" class="inline-block"> --}}
        {{-- <a href="" class="inline-block link-to-add" data-bs-toggle="modal" data-bs-target="#modalAdd"> --}}
        <div class="inline-block" id="link-to-add">
            <button class="btn-style menu-item link-to-add">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            Create subject</button>
        </div>
    </div>

    <div class="mb-5 d-flex justify-content-end" autocomplete="off">
        <input type="text" placeholder="Search..." id="keywords" name="keywords" class="input-search">
        <button class="btn btn-primary menu-item" id="goSearch" style="margin-left: 10px;">Search</button>
    </div>
    {{-- <form class="mb-5 d-flex justify-content-end" autocomplete="off"> --}}
    {{-- </form> --}}

    <div class="table-main">
        <table>
            <thead>
              <tr>
                <th>
                    <input type="checkbox" id="select_all_ids checkAll">
                </th>
                <th>Name
                    <button class="btn-a-z" id="a-z"><i class="fa-solid fa-arrow-down-a-z"></i></button>
                    <button class="btn-z-a" id="z-a"><i class="fa-solid fa-arrow-down-z-a"></i></button>
                </th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tbSubject"></tbody>
            </tbody>
          </table>
    </div>
    <ul class="pagination">     
        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
        <span class="page-link" aria-hidden="true">‹</span>
        </li>
        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item">
        <a class="page-link" href="#" rel="next" aria-label="Next »">›</a>
        </li>
    </ul>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // document.getElementById("dashboard-content").classList.add("d-none");
        //Khởi tạo sự kiện trước khi load
        $(document).ready(function() {
            //Bắt sự kiện cho btn-add
            $('.link-to-add').on('click', function(e) {
                var self = this; 
                $('.loader-sub').attr('class', 'loader-subject');
                // $('.loader-sub').attr('class', 'loader-subject');
                // $(self.container).html('<div id="loader-subject" class="loader-sub"></div>');
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/addSubject',
                    type: 'GET',
                    dataType: 'html',
                    success: function(response) {
                        // console.log(response);
                        $('.subjectRender').html(response);
                    },
                    complete: function() {

                        // $('.loader-sub').attr('class', 'loader-subject--hidden');
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
            subject.list = new DataListSub();
            subject.list.load();
        });
       
      
        //Class danh sách dữ liệu
        var DataListSub  = class DataListSub{
            constructor() {
                this.url = 'http://127.0.0.1:8000/api/getAllSubject';
                this.urlz = 'http://127.0.0.1:8000/api/getAllSubjectZA';
                this.urlsearch = 'http://127.0.0.1:8000/api/getSearchSubject';
                this.container = "#tbSubject";
            }
            
            //Hàm hiển thị danh sách
            load() {
                // console.log("a-z");
                $("#z-a").hide();
                var self = this; 
                $('.loader-sub').attr('class', 'loader-subject');
                $.ajax({
                        url: this.url,
                        type: 'GET',
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                            $('.loader-subject').css('display', 'none');
                        },
                        
                    })
                    .done(function(result) {
                        // console.log("xoa load");
                        // $(".loader-sub").hide();    
                        // $('.loader-sub').attr('class', 'loader');
                        //Sau khi lấy danh sach -> render ra table
                        $(self.container).html(
                            result.subjects.map(e => {
                                return `<tr>
                                <td><input class="form-check-input toCheck" type="checkbox" data-item="${e.id}"></td>
                                <td>${e.name}</td>
                                <td>${e.description}</td>
                                <td>
                                    <div class="actions-style">
                                    {{-- Edit --}}
                                    <button class="btn-edit" data-item="${e.id}" class="menu-item" data-bs-toggle="tooltip"
                                        title="Edit">
                                        <span
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                    {{-- Delete --}}

                                    <button class="btn-delete" data-item="${e.id}" data-bs-toggle="tooltip" title="Delete">
                                        <span
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
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
                $('.loader-sub').attr('class', 'loader-subject');
                $.ajax({
                    url: `http://127.0.0.1:8000/api/deleteSubject/${$(element).attr("data-item")}`,
                    type: 'DELETE',
                    dataType: 'html',
                    accepts: {
                        mycustomtype: 'application/x-some-custom-type'
                    },
                    success: function(response) {
                        $('.loader-sub').attr('class', 'loader-subject--hidden');
                        self.load() 
                        //Load lại sau khi xóa
                    }
                })

            }
          
            loadz() {
                var self = this; 
                $('.loader-subject').css('display', 'flex');
                $.ajax({
                        url: this.urlz,
                        type: 'GET',
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                            $('.loader-subject').css('display', 'none');
                        },
                        
                    })
                    .done(function(result) {
                        // $('.loader-sub').attr('class', 'loader-subject--hidden');
                        //Sau khi lấy danh sach -> render ra table
                        $(self.container).html(
                            result.subjects.map(e => {
                                return `<tr>
                                <td><input class="form-check-input toCheck" type="checkbox" data-item="${e.id}"></td>
                                <td>${e.name}</td>
                                <td>${e.description}</td>
                                <td>
                                    <div class="actions-style">
                                    {{-- Edit --}}
                                    <a class="btn-edit" data-item="${e.id}" class="menu-item" data-bs-toggle="tooltip"
                                        title="Edit">
                                        <span
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    {{-- Delete --}}

                                    <button class="btn-delete" data-item="${e.id}" data-bs-toggle="tooltip" title="Delete">
                                        <span
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
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
                $('.loader-sub').attr('class', 'loader-subject');
                $.ajax({
                    url: this.urlsearch,
                    type: 'GET',
                    data: { key: key }, // Truyền giá trị key
                    dataType: 'json',
                    success: function(response) {
                        // Xử lý phản hồi thành công từ server
                        console.log(response.subjects);
                    
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi khi yêu cầu không thành công
                        console.log(error);
                    },  
                })
                .done(function(result) {
                    $('.loader-sub').attr('class', 'loader-subject--hidden');
                        //Sau khi lấy danh sach -> render ra table
                        $(self.container).html(
                            result.subjects.map(e => {
                                return `<tr>
                                <td><input class="form-check-input toCheck" type="checkbox" data-item="${e.id}"></td>
                                <td>${e.name}</td>
                                <td>${e.description}</td>
                                <td>
                                    <div class="actions-style">
                                    {{-- Edit --}}
                                    <a class="btn-edit" data-item="${e.id}" class="menu-item" data-bs-toggle="tooltip"
                                        title="Edit">
                                        <span
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                                    {{-- Delete --}}

                                    <button class="btn-delete" data-item="${e.id}" data-bs-toggle="tooltip" title="Delete">
                                        <span
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
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
                        // $(self.container).html('<div id="loader" class="loader"></div>');
                        $('.loader-sub').attr('class', 'loader-subject');
                        number = $(element).attr('data-item');
                        var url = `http://127.0.0.1:8000/api/editSubject/${(number)}`;
                        $('.loader-sub').attr('class', 'loader-subject');
                        $.ajax({
                            url: url,
                            type: 'GET',
                            dataType: 'html',
                            success: function(response) {
                                // $('.loader-sub').attr('class', 'loader-subject--hidden');
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
                    $('.loader-subject').css('display', 'flex');
                    self.load();
                });
                $('#goSearch').on('click', function() {
                    var value = $('input[name="keywords"]').val();
                    console.log(value);
                    self.loadsearch(value);
                    // e.preventDefault();
                    // $(self.container).html('<div id="loader" class="loader"></div>');
                    
                });
                $('.inputzzz').each(function(index, element) {
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
