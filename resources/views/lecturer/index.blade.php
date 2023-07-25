@extends('layout')

@section('content')
<title>Lecturers</title>

{{-- Lecturers --}}
<div class="dashboard-children active main-content">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Lecturers
            </h1>
            <p class="dashboard-short-desc">Manage your lecturer</p>
        </div>

        {{-- New lecturer --}}
        <div class="inline-block" id="link-to-add">
            <button class="btn-style menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            Create lecturer</button>
        </div>
    </div>

    {{-- Search --}}
    <form id="formSearch" class="mb-5 d-flex justify-content-end" autocomplete="off">
        <input type="text" placeholder="Search lecturer..." id="keywords" name="keywords" class="input-search">
        <button type="submit" id="btnSearch" class="btn btn-primary menu-item" style="margin-left: 10px;">Search</button>
    </form>

    {{-- Table --}}
    <div class="table-main">
        {{-- Thông báo alert --}}
        @if (Session::has('thongbao'))
            <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-alert">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>                  
                {{Session::get('thongbao')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Data is empty --}}
        @if ($allLecturers->isEmpty())
            <div class="alert alert-info d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-alert">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                Data is empty
            </div>
        @endif

        @if ($allLecturers->isNotEmpty())
            {{-- Delete all selected --}}
            <a id="deleteAllSelectedRecord" href="" >
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn-style icon-delete menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                Delete all selected</button>
            </a>
        @endif

        <table>
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select_all_ids">
                    </th>
                    <th style="width: 80px;">@sortablelink('id')</th>
                    <th>
                        {{-- Name
                        <button id="btn_sort_name" value="0"><i id="icon_sort_name"
                            class="fa-solid fa-arrow-down-a-z icon-sort"></i></button> --}}
                            @sortablelink('name')
                    </th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>
                        {{-- Created at
                        <button id="btn_sort_created_at" value="0"><i id="icon_sort_created_at"
                            class="fa-solid fa-arrow-down-short-wide icon-sort"></i></button> --}}
                            @sortablelink('created_at')
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($allLecturers->count())
                    @foreach ($allLecturers as $item)
                    <tr id="lecturer_ids{{ $item->id }}">
                        <td>
                            <input type="checkbox" name="ids" class="checkbox_ids" value="{{$item->id}}">
                        </td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->birthday}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <div class="actions-style">
                                {{-- Edit --}}
                                <button data-item="{{$item->id}}" class="menu-item" id="btn-edit" value="{{$item->id}}">
                                    <span
                                        class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                                {{-- Delete --}}
                                <button type="button" id="btn_delete_lecturer" value="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                    <span
                                        class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </span>
                                </button>

                            </div>
                        </td>
                    </tr>

                    <!-- The Modal for Delete Lecture -->
                    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                    <input type="hidden" id="lecturer_id">
                                    <p>You won't be able to revert this!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="btn_confirm_delete_lecturer" class="btn btn-danger"
                                        data-bs-dismiss="modal">Yes, delete it!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Modal delete all --}}
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-confirm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <div class="material-icons">!</div>
                </div>
                <h2 class="modal-title">Are you sure?</h2>
            </div>
            <div class="modal-body">
                <p>You won't be able to revert this!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="btnDelete" data-bs-dismiss="modal">Yes, delete
                    it!</button>
            </div>
        </div>
    </div>
</div>

<div id="pagination">
    {!! $allLecturers->appends(\Request::except('page'))->render() !!}
    {{-- {{ $allLecturers->links() }} --}}
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="{{ asset ('/js/toast.js') }}"></script>

<script>
    document.getElementById("lecturer").classList.add("active");
    document.getElementById("dashboard-content").classList.add("d-none");
    document.getElementById("dashboard").classList.remove("active");


    // GET dữ liệu
    $(document).ready(function() {
        function loadDataTable(data) {
            $('tbody').html('');
            $.each(data, function(key, item) {
                $('tbody').append('<tr id="'+ item.id +'">\
                <td><input type="checkbox" name="ids" class="checkbox_ids" value="'+ item.id +'"></td>\
                <td>' + item.id + '</td>\
                <td>' + item.name + '</td>\
                <td>' + item.address + '</td>\
                <td>' + item.phone + '</td>\
                <td>' + item.birthday + '</td>\
                <td>' + moment(item.created_at).format('DD-MM-YYYY HH:mm:ss') + '</td>\
                <td>\
                    <div class="actions-style">\
                        <button type="button" id="btn-edit" value="'+ item.id +'" class="menu-item">\
                            <span\
                                class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">\
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"\
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">\
                                    <path stroke-linecap="round" stroke-linejoin="round"\
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">\
                                    </path>\
                                </svg>\
                            </span>\
                        </button>\
                        <button type="button" id="btn_delete_lecturer" value="'+ item.id +'" data-bs-toggle="modal" data-bs-target="#modalDelete">\
                            <span\
                                class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">\
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"\
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">\
                                    <path stroke-linecap="round" stroke-linejoin="round"\
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">\
                                    </path>\
                                </svg>\
                            </span>\
                        </button>\
                    </div>\
                </td>\
                \</tr>');
            });
        }

        // Delete lecturer
        $(document).on('click', '#btn_delete_lecturer', function () {
            var lecturer_id = $(this).val();
            $('#lecturer_id').val(lecturer_id);
        });

        // Update lecturer (update in database)
        $(document).on('click', '#btn_confirm_delete_lecturer', function (e) {
            e.preventDefault();

            displayLoader($('tbody'));

            var lecturer_id = $('#lecturer_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/delete-lecturer/" + lecturer_id,
                dataType: "json",
                success: function (response) {
                    loadDataTable();
                    loadDataTable(response.allLecturers.data);
                    showSuccessToast("You have successfully deleted lecturer.");
                    removeLoader();
                }
            });
        });

        // Select all
        var temp = 0;
        $("#select_all_ids").click(function() {
            $(".checkbox_ids").prop("checked", $(this).prop("checked"));

            if ($(this).prop('checked')) {
                $('#deleteAllSelectedRecord').css({
                    display: 'block'
                });
            } else {
                $('#deleteAllSelectedRecord').css({
                    display: 'none'
                });
                temp = 0;
            }
        });
        var arr_checkbox = $('.checkbox_ids');
        $(arr_checkbox).each(function() {
            $(this).on('click',function (e) {
            if ($(this).prop('checked')) {
                temp++;
                if (temp == arr_checkbox.length) {
                    $('#select_all_ids').prop('checked', true);
                    $('#deleteAllSelectedRecord').css({display:'block'});
                }
            }
            else{
                temp--;
                $('#select_all_ids').prop('checked', false);
                $('#deleteAllSelectedRecord').css({display:'none'});
            }  
            
            if (temp >= 1){
                $('#deleteAllSelectedRecord').css({display:'block'});
            }
            else{
                $('#select_all_ids').prop('checked', false);
                $('#deleteAllSelectedRecord').css({display:'none'});
            }
            });
        });
        // Delete all
        $('#deleteAllSelectedRecord').click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val())
            });

            $('#btnDelete').click(function(e) {
                displayLoader($('tbody'));

                $.ajax({
                    url: "{{ route('deleteAll') }}",
                    type: "DELETE",
                    data: {
                        ids: all_ids,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $.each(all_ids, function(key, val) {
                            $('#lecturer_ids' + val).remove();
                        })
                        $('#select_all_ids').prop('checked', false);
                        $('#deleteAllSelectedRecord').css({display:'none'});
                        loadDataTable(response.allLecturers.data);
                        showSuccessToast("Delete all successfully.");
                    }
                })
            })
        })

        // Update contact (Change into Update contact page)
        $(document).on('click', '#btn-edit', function () {
            // Display loader spinner
            $('#pagination').css({display:'none'});
            displayLoader($('.main-content'))

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "lecturers/edit/" + $(this).val(),
                type: "GET",
                dataType: "html",
                success: function (response) {
                    //Romove loader spinner
                    removeLoader();
                    // Load content
                    $('.subjectRender').html(response);
                }
            });
        });

        // Search
        $('#formSearch').submit(function(e) {
            e.preventDefault();
            
            displayLoader($('tbody'));

            $.ajax({
                url: '/searchLecturers',
                data: {keywords: $('#keywords').val()},
                dataType: "json",
                success: function (response) {
                    removeLoader();
                    loadDataTable(response.result.data);
                },
                error: function (response) {
                    showErrorToast("Can not find lecturer.");
                    removeLoader();
                }
            });
        });

        // Move add page
        $(document).on('click', '#link-to-add', function (e) {
            e.preventDefault();
            // Display loader spinner
            displayLoader($('.main-content'));
            $('#pagination').css({display:'none'});
    
            $.ajax({
                url: 'lecturers/create',
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    //Romove loader spinner
                    removeLoader();
                    // Load content
                    $('.subjectRender').html(response);
                }
            });
        });

        // // Sort Name field
        // $('#btn_sort_name').on('click', function () {
        //     // Display loader
        //     displayLoader($('tbody'));
        //     var btn = $(this);
        //     $.ajax({
        //         url: '/sortLecturersName',
        //         data: {
        //             status: btn.val()
        //         },
        //         dataType: "json",
        //         success: function (response) {
        //             // Load data 
        //             loadDataTable(response.allLecturers.data);
        //             // Remove loader
        //             removeLoader();
        //             // Change icon
        //             changIconSortName();
        //             // Change status
        //             if (btn.val() == 0) {
        //                 btn.val('1');
        //             }
        //             else {
        //                 btn.val('0');
        //             }
        //         },
        //         error: function () {
        //             console.log('Error');
        //         }
        //     });
        // });

        // // Sort Created_at field
        // $('#btn_sort_created_at').on('click', function () {
        //     // Display loader
        //     displayLoader($('tbody'));
        //     var btn = $(this);
        //     $.ajax({
        //         url: '/sortLecturersCreatedAt',
        //         data: {
        //             status: btn.val()
        //         },
        //         dataType: "json",
        //         success: function (response) {
        //             // Load data 
        //             loadDataTable(response.allLecturers.data);
        //             // Remove loader
        //             removeLoader();
        //             // Change icon
        //             changIconSortCreatedAt();
        //             // Change status
        //             if (btn.val() == 0) {
        //                 btn.val('1');
        //             }
        //             else {
        //                 btn.val('0');
        //             }
        //         },
        //         error: function () {
        //             console.log('Error');
        //         }
        //     });
        // });

        function displayLoader(element) {
            element.html('');
            element.html('<div class="load d-block text-center m-auto mt-5"></div>');
            for (let i = 0; i < 3; i++) {
                $('.load').append('<div class="spinner-grow text-info ms-1"></div>');
            }
        }

        function removeLoader() {
            $('.load').remove();
        }

        // function changIconSortName() {
        //     var btn = $('#btn_sort_name');
        //     var icon = $('#icon_sort_name');
        //     if (btn.val() == 0) {
        //         icon.removeClass('fa-arrow-down-a-z');
        //         icon.addClass('fa-arrow-down-z-a');
        //     }
        //     else {
        //         icon.removeClass('fa-arrow-down-z-a');
        //         icon.addClass('fa-arrow-down-a-z');
        //     }
        // }

        // function changIconSortCreatedAt() {
        //     var btn = $('#btn_sort_created_at');
        //     var icon = $('#icon_sort_created_at');
        //     if (btn.val() == 0) {
        //         icon.removeClass('fa-arrow-down-short-wide');
        //         icon.addClass('fa-arrow-down-wide-short');
        //     }
        //     else {
        //         icon.removeClass('fa-arrow-down-wide-short');
        //         icon.addClass('fa-arrow-down-short-wide');
        //     }
        // }
    });  
</script>
@endsection