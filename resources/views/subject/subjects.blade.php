
@extends('layout')
@section('content')
    
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
        <div class="inline-block" id="btn-add">
            <button class="btn-style menu-item link-to-add">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            Create subject</button>
        </div>
    </div>
    <div class="d-flex mb-5">
    {{-- Delete all selected --}}
        <a id="deleteAllSelectedRecord" href="#">
            {{--  data-bs-toggle="modal" --}}
            <button type="button" id="deleteAll" data-bs-target="#exampleModal2"
                class="btn-style icon-delete menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
                Delete all selected</button>
        </a>
        <div class="d-flex justify-content-end flex-fill" autocomplete="off">
            <input type="text" placeholder="Search..." id="keywords" name="keywords" class="input-search">
            <button class="btn btn-primary menu-item" id="goSearch" style="margin-left: 10px;">Search</button>
        </div>
    </div>
    
    <div class="table-main">
        <div class="alert alert-info" style="display: none ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="icon-alert">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            Data is empty
        </div>
    
        <table>
            <thead>
              <tr>
                <th>
                    <input type="checkbox" id="checkAll">
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

    {{-- {{ $subjects->links() }} --}}
    
    <div class="page-subjects col-md-12"></div>
    <!-- The Modal for Delete Subject -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
       <div class="modal-dialog modal-confirm modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <div class="icon-box">
                       <div class="material-icons">!</div>
                   </div>
                   <h2 class="modal-title">Are you sure?</h2>
               </div>
               <div class="modal-body">
                   <input type="hidden" id="subject_id">
                   <p>You won't be able to revert this!</p>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                   {{-- @isset($subject) --}}
                       <button type="button" class="btn btn-danger">Yes, delete it!</button>
                   {{-- @endisset --}}
               </div>
           </div>
       </div>
   </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#subject-page').addClass('active');
        $("#z-a").toggleClass('blue-background');
        $("#z-a").hide();

        //Khởi tạo sự kiện trước khi load
        $(document).ready(function() {
            
            //Bắt sự kiện cho btn-add
            $('#deleteAllSelectedRecord').on('click', function(e) {
                // console.log(subject.list.arrSub); DeleteSubject

                if ($('#checkAll').prop('checked')) {
                    subject.list.arrAllSub.forEach(function(itemId) {
                        if (subject.list.arrSub.includes(itemId)) {
                            subject.list.DeleteSubject(itemId);
                            subject.list.loadCheck();
                            $('#deleteAllSelectedRecord').css('display', 'none');
                        }
                    });

                } else {
                    subject.list.arrSub.forEach(function(itemId) {
                        if (subject.list.arrSub.includes(itemId)) {
                            subject.list.DeleteSubject(itemId);
                            subject.list.loadCheck();
                            $('#deleteAllSelectedRecord').css('display', 'none');
                        }
                    });
                    // Các hành động khác tùy ý
                }
                

            });
            $('#btn-add').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của nút (chuyển hướng)
                var addRoute = "{{ route('addSubject') }}"; // Lấy đường dẫn tới tuyến "subject"
                window.location.href = addRoute;
            });
            $('input[name="keywords"]').keypress(function(e) {
                if (e.which == 13) { // Kiểm tra phím Enter
                    e.preventDefault(); // Ngăn chặn hành vi mặc định của phím Enter (thường là gửi form)
                    
                    var keywords = $(this).val();
                    const urlParams = new URLSearchParams(window.location.search);
                    const sortParam = urlParams.get('sort');
                    const pageParam = urlParams.get('page');
                    let newPath = "/subjects";
                    
                    if (pageParam || sortParam) {
                        newPath += "?";
                        if(pageParam && sortParam == null){
                            newPath += `keyword=${keywords}`;
                        }
                        if (sortParam) {
                            newPath += `keyword=${keywords}&sort=${sortParam}`;
                        }
                    }
                    else{
                        newPath += `?keyword=${keywords}`;
                    }
                    window.history.pushState(null, null, newPath);
                    subject.list.load(keywords, sortParam);
                }
            });
            $('#goSearch').on('click', function() {
                    var keywords = $('input[name="keywords"]').val();
                    const urlParams = new URLSearchParams(window.location.search);
                        const sortParam = urlParams.get('sort');
                        const pageParam = urlParams.get('page');
                        let newPath = "/subjects";

                        if (pageParam || sortParam) {
                            newPath += "?";
                            if(pageParam && sortParam == null){
                                newPath += `keyword=${keywords}`;
                            }
                            if (sortParam) {
                                newPath += `keyword=${keywords}&sort=${sortParam}`;
                            }
                        }
                        else{
                            newPath += `?keyword=${keywords}`;
                        }
                        window.history.pushState(null, null, newPath);
                        subject.list.load(keywords,sortParam)
            });
            $('.btn-a-z').on('click', function(e) {  
                    if ($('.btn-a-z').hasClass('blue-background')) {
                        $("#a-z").hide();
                        $('.btn-a-z').removeClass('blue-background');
                        $("#z-a").show();
                        var sortType = 'Za';
                        var currentSort = window.location.search;
                        var newSort;
                        if (currentSort.includes('sort=')) {
                            newSort = currentSort.replace(/(sort=)[^&]*/, `$1${sortType}`);
                        } 
                        else{
                            newSort = currentSort ? `${currentSort}&sort=${sortType}` : `?sort=${sortType}`;
                        }
                            window.history.pushState(null, null, newSort);
                            const urlParams = new URLSearchParams(window.location.search);
                            const keywordParam = urlParams.get('keyword');
                            const pageParam = urlParams.get('page');
                            subject.list.load(keywordParam, sortType, pageParam);                                 
                    }
                    else{
                        $(this).toggleClass('blue-background');
                        var sortType = 'Az';
                        // subject.list.load('',sortType);
                        var currentSort = window.location.search;
                        var newSort;
                        if (currentSort.includes('sort=')) {
                            newSort = currentSort.replace(/(sort=)[^&]*/, `$1${sortType}`);
                        } 
                        else{
                            newSort = currentSort ? `${currentSort}&sort=${sortType}` : `?sort=${sortType}`;
                        }
                        window.history.pushState(null, null, newSort);
                            const urlParams = new URLSearchParams(window.location.search);
                            const keywordParam = urlParams.get('keyword');
                            const pageParam = urlParams.get('page');
                            subject.list.load(keywordParam, sortType, pageParam);   
                    }
            });
            $('.btn-z-a').on('click', function(e) {
                if ($('.btn-z-a').hasClass('blue-background')) {
                        $("#z-a").hide();
                        $("#a-z").show();
                        const urlParams = new URLSearchParams(window.location.search);
                        const keywordParam = urlParams.get('keyword');
                        const pageParam = urlParams.get('page');
                        let newPath = "/subjects";
                        if (keywordParam || pageParam) {
                            newPath += "?";
                            if (keywordParam) {
                                newPath += `keyword=${keywordParam}`;
                            }
                            if (pageParam) {
                                newPath += `${keywordParam ? '&' : ''}page=${pageParam}`;
                            }
                        }
                        window.history.pushState(null, null, newPath);
                        subject.list.load(keywordParam,'', pageParam);
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            const sortParam = urlParams.get('sort');
            if(sortParam == 'Az'){
                    $("#a-z").show();
                    $("#a-z").toggleClass('blue-background');
            }
            if(sortParam == 'Za'){
                $("#z-a").show();
                $("#a-z").hide();
            }
        });
        
        var subject = {
            list: null,
        };
       
        $(function() {
            subject.list = new DataListSub();

            const urlParams = new URLSearchParams(window.location.search);
            const keywordParam = urlParams.get('keyword');
            const pageParam = urlParams.get('page');
            const sortParam = urlParams.get('sort');
            subject.list.load(keywordParam, sortParam, pageParam);
            subject.list.loadCheck();
        });
       
      
        //Class danh sách dữ liệu
        var DataListSub  = class DataListSub{
            constructor() {
                this.url = 'http://127.0.0.1:8000/api/getAllSubject';
                this.container = "#tbSubject";
                this.arrSub = [];
                this.arrAllSub = [];
            }
            //Hàm hiển thị danh sách

            load(keywords, sortType, page) {                
                var self = this; 
                // $('.loader-sub').attr('class', 'loader-subject');
                $.ajax({
                        url: 'http://127.0.0.1:8000/api/getAllSubject',
                        type: 'GET',
                        data: {
                            sort : sortType,
                            keyword: keywords,
                            page: page,
                        },
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                            $('.loader-subject').css('display', 'none');
                        },
                    })
                    .done(function(result) {
                        if (result && result.subjects && result.subjects.data && result.subjects.data.length > 0) {
                                $('.alert-info').css('display','none')
                            // console.log("xoa load");
                            // $(".loader-sub").hide();    
                            // $('.loader-sub').attr('class', 'loader');
                            //Sau khi lấy danh sach -> render ra table
                            $(self.container).html(
                            
                                result.subjects.data.map(e => {
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
                            $('.page-subjects').html(result.link)
                            self.loadPage();
                            self.loadChecked();
                            self.AfterLoadEvent();
                        }else{
                            $('.alert-info').css('display','block');
                            $(self.container).html(
                                result.subjects.data.map(e => {
                                    return null;
                                }).join('')
                            );
                            $('.page-subjects').html(result.link)
                            self.loadPage();
                        }
                });
            }
            loadPage() {
                    var self = this
                    var pageElement = 1
                    $('.page-item').each(function(i, e) {
                        if ($(e).attr('class') == 'page-item active') {
                            //Nếu trang đó đang được bấm thì gán lại pageElement
                            pageElement = parseInt($(e).text())
                            // console.log("Gán lại pageElement: "+pageElement);
                        }
                    })
                    $('.page-link').each(function(i, element) {
                        $(element).click(function(e) {
                            e.preventDefault();
                            if ($(element).attr('rel') == 'next') {
                                //Load theo trang sau
                                pageElement += 1
                                var currentPage = window.location.search;
                                var newPage;
                                if (currentPage.includes('page=')) {
                                    newPage = currentPage.replace(/(page=)[^&]*/, `$1${pageElement}`);
                                } else {
                                    newPage = currentPage ? `${currentPage}&page=${pageElement}` : `?page=${pageElement}`;
                                }
                                window.history.pushState(null, null, newPage);
                                const urlParams = new URLSearchParams(window.location.search);
                                const keywordParam = urlParams.get('keyword');
                                const pageParam = urlParams.get('page');
                                const sortParam = urlParams.get('sort');
                                self.load(keywordParam, sortParam, pageParam);
                            } else if ($(element).attr('rel') == 'prev') {
                                 //Load theo trang trước
                                pageElement -= 1
                                // self.load('', '', pageElement);
                                var currentPage = window.location.search;
                                var newPage;
                                if (currentPage.includes('page=')) {
                                    newPage = currentPage.replace(/(page=)[^&]*/, `$1${pageElement}`);
                                } else {
                                    newPage = currentPage ? `${currentPage}&page=${pageElement}` : `?page=${pageElement}`;
                                }
                                window.history.pushState(null, null, newPage);
                                const urlParams = new URLSearchParams(window.location.search);
                                const keywordParam = urlParams.get('keyword');
                                const pageParam = urlParams.get('page');
                                const sortParam = urlParams.get('sort');
                                self.load(keywordParam, sortParam, pageParam);
                            } else {
                                //Load theo số page
                                var currentPage = window.location.search;
                                var newPage;
                                if (currentPage.includes('page=')) {
                                    newPage = currentPage.replace(/(page=)[^&]*/, `$1${$(element).text()}`);
                                } else {
                                    newPage = currentPage ? `${currentPage}&page=${$(element).text()}` : `?page=${$(element).text()}`;
                                }
                                window.history.pushState(null, null, newPage);
                                const urlParams = new URLSearchParams(window.location.search);
                                const keywordParam = urlParams.get('keyword');
                                const pageParam = urlParams.get('page');
                                const sortParam = urlParams.get('sort');
                                self.load(keywordParam, sortParam, pageParam);
                            }
                        });
                    });
            }
            loadChecked(){
                var self = this;
                self.arrSub.forEach(function(itemId) {
                    $('.toCheck[data-item="' + itemId + '"]').prop('checked', true);
                });
            }
            //Lay tat ca sub vao mang subAllCheck
            loadCheck(){
                var self = this;
                $.ajax({
                        url: 'http://127.0.0.1:8000/api/getAll',
                        type: 'GET',
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                        },
                    })
                    .done(function(result) {
                        if (result && result.subjects && Array.isArray(result.subjects)) {
                            self.arrAllSub = [];
                            result.subjects.forEach(function(subject) {
                                var subjectId = subject.id;
                                self.arrAllSub.push(subjectId);
                            });
                        } else {
                            console.log("Không có dữ liệu hoặc dữ liệu không hợp lệ");
                        }
                    });
               
            }
            //Hàm xóa Subject $(element).attr("data-item")
            DeleteSubject(element) {
                var self = this;
                var previousURL = window.location.href;
                $('#confirmDeleteModal').modal('hide');
                $('.loader-sub').attr('class', 'loader-subject');
                // $('.loader-subject').css('display', 'flex');
                $('.btn-z-a').removeClass('blue-background');
                $.ajax({
                    url: `http://127.0.0.1:8000/api/deleteSubject/${element}`,
                    type: 'DELETE',
                    dataType: 'html',
                    accepts: {
                        mycustomtype: 'application/x-some-custom-type'
                    },
                    success: function(response) {
                        $('.loader-subject').css('display', 'none'); 
                       
                        const urlParams = new URLSearchParams(window.location.search);
                            const keywordParam = urlParams.get('keyword');
                            const pageParam = urlParams.get('page');
                            const sortParam = urlParams.get('sort');
                            self.load(keywordParam,sortParam,pageParam);

                            history.pushState(null, null, previousURL);
                    }
                })

            }
          
            //Hàm Sự kiện sau khi load
            AfterLoadEvent() { 
                var self = this; 
                var subjectId = ''// Lưu trữ tham chiếu đến đối tượng DataList
                $('.btn-delete').each(function(index, element) {
                    //Gọi hàm DeleteSubject và xóa theo id
                    $(element).click(function() {
                        subjectId = $(element).data('item');
                        $('#confirmDeleteModal').modal('show');
                    });
                });
                $('.modal-footer .btn-danger').on('click', function() {
                    if (subjectId) {
                        self.DeleteSubject(subjectId);
                    }
                });
                $('#confirmDeleteModal').on('hidden.bs.modal', function () {
                    if (subjectId) {
                        subjectId = null;
                    }
                });
                $('.modal-footer .btn-info').on('click', function() {
                    $('#confirmDeleteModal').modal('hide'); // Đóng modal
                });

                $('#checkAll').on('click', function(e) {
                    $('#deleteAllSelectedRecord').css('display', 'block');
                    if ($(this).prop('checked')) {
                        self.arrSub = [];
                        self.arrSub = self.arrSub.concat(self.arrAllSub);
                        self.arrSub.forEach(function(itemId) {
                        $('.toCheck[data-item="' + itemId + '"]').prop('checked', true);
                    });
                    } else {
                        self.arrSub = [];
                        $('.toCheck').prop('checked', false);
                        $('#deleteAllSelectedRecord').css('display', 'none');
                    }
                    
                });
                $('.toCheck').each(function(index, element) {
                    //Gọi hàm DeleteSubject và xóa theo id
                    $(element).click(function() {
                        
                        if ($(this).prop('checked')) {
                            // console.log("Element này đã được chọn.");
                            self.arrSub.push($(this).data('item'));
                        } else {
                            // console.log("Element này chưa được chọn.");
                            const itemToRemove = $(this).data('item');
                            const indexToRemove = self.arrSub.indexOf(itemToRemove);
                            if (indexToRemove !== -1) {
                                self.arrSub.splice(indexToRemove, 1);
                            }
                        }
                        // console.log(self.arrSub);
                        // console.log('Mang tat cả :'+self.arrAllSub);


                        var allChecked = true;
                        var allNoCheck = true;
                        $('#deleteAllSelectedRecord').css('display', 'block');


                        self.arrAllSub.forEach(function(itemId) {
                            if (self.arrSub.indexOf(itemId) === -1) {
                                // console.log("Phần tử " + itemId + " không tồn tại trong mảng arrSub");
                                allChecked = false;
                            }
                            else{
                                allNoCheck = false;
                            }
                        });
                        if (allChecked) {
                            $('#checkAll').prop('checked', true);
                            // console.log("tat ca da dc check");
                        } else {
                            $('#checkAll').prop('checked', false);
                            // console.log("tat ca chua dc check");
                        }
                        if (allNoCheck) {
                            $('#deleteAllSelectedRecord').css('display', 'none');
                        }
                    });
                });

                // $('#deleteAllSelectedRecord').css('display', 'block');
                $('.btn-edit').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của nút (chuyển hướng)
                var subjectId = $(this).data('item');
                var editRoute = "{{ route('updateSubject', ['id' => ':id']) }}";  // Lấy đường dẫn tới tuyến "subject"
                editRoute = editRoute.replace(':id', subjectId);
                window.location.href = editRoute;
                }); 
            }
        }
    </script>
@endsection