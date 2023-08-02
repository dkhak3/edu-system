
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

    <div class="mb-5 d-flex justify-content-end" autocomplete="off">
        <input type="text" placeholder="Search..." id="keywords" name="keywords" class="input-search">
        <button class="btn btn-primary menu-item" id="goSearch" style="margin-left: 10px;">Search</button>
    </div>
    {{-- <form class="mb-5 d-flex justify-content-end" autocomplete="off"> --}}
    {{-- </form> --}}
    
    {{-- Delete all selected --}}
    <a id="deleteAllSelectedRecord" href="">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2"
            class="btn-style icon-delete menu-item">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
            </svg>
            Delete all selected</button>
    </a>
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
        $('#dashboard').removeClass('active');
        $('#dashboard-content').addClass('d-none');
        $("#z-a").toggleClass('blue-background');
        $("#z-a").hide();
        //Khởi tạo sự kiện trước khi load
        $(document).ready(function() {
            //Bắt sự kiện cho btn-add
            $('#btn-add').on('click', function(e) {
                //Chuyển trang đến router add như href="{{ route('subject') }}"
                e.preventDefault(); // Ngăn chặn hành vi mặc định của nút (chuyển hướng)
                var addRoute = "{{ route('addSubject') }}"; // Lấy đường dẫn tới tuyến "subject"
                window.location.href = addRoute;
            });
            $('#goSearch').on('click', function() {
                    var keywords = $('input[name="keywords"]').val();
                    // var keywords = 'b';
                    subject.list.load(keywords)
                    var history = window.history || window.location.history;
                    history.pushState(null, null, `/search?keyword=${keywords}`);
                    // e.preventDefault();
                    // $(self.container).html('<div id="loader" class="loader"></div>');
            });
            $('.btn-a-z').on('click', function(e) {  
                    if ($('.btn-a-z').hasClass('blue-background')) {
                        $("#a-z").hide();
                        $('.btn-a-z').removeClass('blue-background');
                        // $("#z-a").toggleClass('blue-background');
                        $("#z-a").show();
                        var sortType = 'Za';
                        subject.list.load('',sortType);
                    }
                    else{
                        $(this).toggleClass('blue-background');
                        var sortType = 'Az';
                        subject.list.load('',sortType);
                    }
            });
            $('.btn-z-a').on('click', function(e) {
                if ($('.btn-z-a').hasClass('blue-background')) {
                        $("#z-a").hide();
                        $("#a-z").show();
                        // $('.btn-z-a').removeClass('blue-background');
                        subject.list.load();
                }
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
                this.container = "#tbSubject";
                this.arrSub = []
            }
            // var keyword = 'b';
            //Hàm hiển thị danh sách

            load(keywords, sortType) {
                // console.log("a-z");
                
                var self = this; 
                // $('.loader-sub').attr('class', 'loader-subject');
                $.ajax({
                        url: 'http://127.0.0.1:8000/api/getAllSubject',
                        type: 'GET',
                        data: {
                            sort : sortType,
                            keyword: keywords,
                        },
                        accepts: {
                            mycustomtype: 'application/x-some-custom-type'
                        },
                        complete: function() {
                            $('.loader-subject').css('display', 'none');
                        },
                        
                    })
                    .done(function(result) {

                        // console.log(result.link);
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
                        self.AfterLoadEvent();    
                        }else{
                            console.log("ko tim thay gi");
                            $('.alert-info').css('display','block')
                        }
                });
            }
            loadPage() {
                    var self = this
                    var pageElement = 1
                    
                    $('.page-item').each(function(i, e) {
                        if ($(e).attr('class') == 'page-item active') {
                            // pageElement = parseInt($(e).text())
                            console.log("page -1");
                        }
                    })
                    $('.page-link').each(function(i, element) {

                        $(element).click(function(e) {

                            e.preventDefault();
                            if ($(element).attr('rel') == 'next') {
                                pageElement += 1
                                // self.load(pageElement, dataCourses.keySearch, dataCourses.sort)
                                console.log("page + 1");
                            } else if ($(element).attr('rel') == 'prev') {
                                pageElement -= 1

                                // self.load(pageElement, dataCourses.keySearch, dataCourses.sort)
                                console.log("page -1");

                            } else {

                                // self.load($(element).text(), dataCourses.keySearch, dataCourses.sort)
                                console.log(" no page");
                            }
                        });
                    });
            }
            //Hàm xóa Subject $(element).attr("data-item")
            DeleteSubject(element) {
                var self = this;
                var history = window.history || window.location.history;
                history.pushState(null, null, `/subjects`);
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
                       
                        // self.load() 
                        if ($('.btn-a-z').hasClass('blue-background')) {
                            console.log("Load a->z");
                            var sortType = 'Az';
                            self.load('',sortType);
                            return;
                        }
                        if ($('.btn-a-z').hasClass('blue-background')==false) {
                            console.log("load thường");
                            self.load() 
                            return;
                        }
                        // if ($('.btn-z-a').hasClass('blue-background')) {
                        //     console.log("load z-a");
                        //     // self.load() 
                        //     return;
                        // }
                        //Load lại sau khi xóa
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
                        subjectId = $(element).data('item');;
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
                        $('.toCheck').prop('checked', true);
                    } else {
                        $('.toCheck').prop('checked', false);
                        $('#deleteAllSelectedRecord').css('display', 'none');
                    }
                });
                $('.toCheck').each(function(index, element) {
                    //Gọi hàm DeleteSubject và xóa theo id
                    $(element).click(function() {
                        var allChecked = true;
                        var allNoCheck = true;
                        $('#deleteAllSelectedRecord').css('display', 'block');

                        $('.toCheck').each(function() {
                            if (!$(this).prop('checked')) {
                                allChecked = false;
                                // return false; // Dừng vòng lặp nếu tìm thấy checkbox chưa được chọn
                            }
                            else{
                                allNoCheck = false;
                            }
                           
                        });
                        if (allChecked) {
                            $('#checkAll').prop('checked', true);
                        } else {
                            $('#checkAll').prop('checked', false);
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