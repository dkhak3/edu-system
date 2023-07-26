        <div class="dashboard-children active">
            {{-- Heading --}}
            <div class="mb-5 d-flex justify-content-between align-items-center">
                <div class="">
                    <h1 class="dashboard-heading">
                        Courses
                    </h1>
                    <p class="dashboard-short-desc">Manage your course</p>
                </div>
                <a href="" class="inline-block" id="createCourses">
                    <button class="btn-style menu-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create course</button>
                </a>
            </div>

            {{-- Search --}}
            <form action="{{ url('contacts') }}" method="GET" class="mb-5 d-flex justify-content-end"
                autocomplete="off">
                <input type="text" id="search" placeholder="Search..." id="search" name="search"
                    class="input-search">
                <button id="searchCourses" class="btn btn-primary menu-item" style="margin-left: 10px;">Search</button>
            </form>

            {{-- Table --}}
            <div class="table-main">
                {{-- Thông báo alert --}}
                @if (Session::has('thongbao'))
                    <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon-alert">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ Session::get('thongbao') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif



                {{-- Data is empty --}}
                
            <div class="alert alert-info" style="display: none ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-alert">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                Data is empty
            </div>
    
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


                <table>
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select_all_ids">
                            </th>
                            <th style="white-space: nowrap;">Name <i style="margin-left: 3px; padding: 5px; cursor: pointer;" id="sort"
                                    class="fa-solid fa-arrow-down-a-z"></i></th>
                            <th class="mbl-none">Description</th>
                            <th style="white-space: nowrap;">Create At <i style="margin-left: 3px; padding: 5px; cursor: pointer;" id="sortTime"
                                    class="fa-solid fa-arrow-down-a-z"></i></th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="renderTB">


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <p>You won't be able to revert this!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form>

                                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes,
                                                delete
                                                it!</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
            <div class="page-courses col-md-12"></div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
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
                        <p>You won't be able to revert this!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="btnDelete" data-bs-dismiss="modal">Yes,
                            delete
                            it!</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- {{ $courses->links() }} --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

        <script>
            var course = {
                list: null,
            };
            var dataCourses = {
                keySearch: "",
                page: 1,
                sort: '',
                tempSortTime: 0,
                tempSort: 0,
                checked: false

            };
            var arrCourses = [];
            $(function() {
                course.list = new DataList();
                course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);

               
            });
            $('#btnDelete').click(function (e) {
                e.preventDefault()
                $.ajax({
                        url: "http://127.0.0.1:8000/api/courses/delete/selected",
                        type: "POST",
                        data: {
                            arrCourses: arrCourses
                        },
                        dataType: "html",
                        success: function(response) {
                            course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);
                        },
                    });
            })
            $("#select_all_ids").click(function(e) {
                if (e.target.checked) {
                    $('#deleteAllSelectedRecord').css('display', 'block');
                    dataCourses.checked = true;
                    $.ajax({
                        url: "http://127.0.0.1:8000/api/courses/all",
                        type: "GET",
                        dataType: "html",
                        success: function(response) {
                            arrCourses = JSON.parse(response).courses;
                            course.list.checklist(arrCourses, dataCourses.checked);
                        },
                    });
                } else {
                    $('#deleteAllSelectedRecord').css('display', 'none');
                    arrCourses = [];
                    dataCourses.checked = false;
                    course.list.checklist(arrCourses, dataCourses.checked);
                }
            });
            $('#deleteAllSelectedRecord').click(function (e) { 
                e.preventDefault();
            });

            $("#search").keydown(function(e) {
                dataCourses.keySearch = e.target.value;
                if (e.keyCode === 13) {
                    e.preventDefault()
                    course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);
                    course.list.checklist(arrCourses);
                }

            });
            $("#searchCourses").click(function(e) {

                e.preventDefault()
                    course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);
                    course.list.checklist(arrCourses);
                

            });
            
            $('#sort').click(function(e) {
                if (dataCourses.tempSort == 0) {
                    dataCourses.sort = 'increaseName'
                    course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)

                    $('#sort').attr('class', 'fa-solid fa-arrow-up-a-z');
                    dataCourses.tempSort++
                } else {
                    dataCourses.sort = 'reduceName'
                    $('#sort').attr('class', 'fa-solid fa-arrow-down-a-z');
                    course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)
                    dataCourses.tempSort = 0
                }
            })

            $('#sortTime').click(function(e) {
                if (dataCourses.tempSortTime == 0) {
                    dataCourses.sort = 'increaseTime'
                    course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)

                    $('#sortTime').attr('class', 'fa-solid fa-arrow-up-a-z');
                    dataCourses.tempSortTime++
                } else {
                    dataCourses.sort = 'reduceTime'
                    $('#sortTime').attr('class', 'fa-solid fa-arrow-down-a-z');
                    course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)
                    dataCourses.tempSortTime = 0
                }
            })

            $("#createCourses").click(function(e) {
                e.preventDefault();
                $('.loader').attr('class', 'loader');


                $.ajax({
                    type: "GET",

                    url: "http://127.0.0.1:8000/api/courses/add/form",

                    dataType: "html",
                    success: function(response) {
                        var history = window.history || window.location.history;
                        history.pushState(null, null, `/courses/add/form`);
                        $(".coursesRender").html(response);
                    },
                    complete: function() {
                        $('.loader').attr('class', 'loader loader--hidden');



                    }
                });

            });
            var DataList = class DataList {
                constructor() {
                    this.url = "http://127.0.0.1:8000/api/courses/search";
                    this.container = "#renderTB";
                    this.arrTemp = []
                }

                load(page, keySearch, sort) {

                    var self = this; // Lưu trữ tham chiếu đến đối tượng DataList
                    $(self.container).html('<tr><td id="loading" class="loading" colspan="6"></td></tr>');
                    $.ajax({
                        url: this.url,
                        type: "GET",
                        data: {
                            page: page,
                            key: keySearch,
                            sort: sort,
                        },
                        dataType: "html",

                        success: function(response) {
                            $("#renderTB").html("");
                            $("#renderTB").html(JSON.parse(response).blade);
                            self.arrTemp = JSON.parse(response).courses
                            if (JSON.parse(response).blade.split('\n')[0][1] != 't') {
                                $('.alert-info').css('display','flex')
                            }else{
                                $('.alert-info').css('display','none')

                            }
                            // self.bindEvent();
                            $('.page-courses').html(JSON.parse(response).link)
                            self.loadPage()
                            self.checklist(arrCourses,dataCourses.checked)
                        },
                        complete: function() {
                            $("#loading").hide();
                        },
                    });
                }
                loadPage() {
                    var self = this
                    var pageElement = 1
                    
                    $('.page-item').each(function(i, e) {
                        if ($(e).attr('class') == 'page-item active') {
                            pageElement = parseInt($(e).text())
                        }
                    })
                    $('.page-link').each(function(i, element) {

                        $(element).click(function(e) {

                            e.preventDefault();
                            if ($(element).attr('rel') == 'next') {
                                pageElement += 1
                                self.load(pageElement, dataCourses.keySearch, dataCourses.sort)
                            } else if ($(element).attr('rel') == 'prev') {
                                pageElement -= 1

                                self.load(pageElement, dataCourses.keySearch, dataCourses.sort)

                            } else {

                                self.load($(element).text(), dataCourses.keySearch, dataCourses.sort)
                            }
                        });
                    });
                }
                checklist(arrCourses, checked) {
                    var self = this
                    if (checked == true) {
                        $(".checklist").each(function(index, e) {
                            $(e).prop("checked", true);
                        });
                    } else {
                        $(".checklist").each(function(index, e) {
                            $(e).prop("checked", false);
                            $(e).attr("checked", false);
                        });
                    }
                    $(".checklist").each(function(index, e) {
                        $(e).click(function() {
                            const check = arrCourses.includes(
                                parseInt($(e).attr("data-item"))
                            );
                            if (check) {
                                arrCourses = arrCourses.filter(
                                    (item) => item !== parseInt($(e).attr("data-item"))
                                );
                            } else {
                                arrCourses = [
                                    ...arrCourses,
                                    parseInt($(e).attr("data-item")),
                                ];
                            }
                            if (self.arrTemp.length == arrCourses.length) {
                                $("#checkall").prop("checked", true);
                            } else {
                                $("#checkall").prop("checked", false);
                                $('#deleteAllSelectedRecord').css('display', 'none');

                            }
                            console.log(arrCourses);
                        });
                    });

                    $('#btnAll').click(function(e) {
                        $(self.container).html('<tr><td id="loading" class="loading" colspan="6"></td></tr>');

                        $.ajax({
                            url: 'http://127.0.0.1:8000/api/courses/delete/courses/all',
                            type: "POST",
                            data: {
                                arrCourses: arrCourses,
                            },
                            dataType: "html",

                            success: function(response) {
                                self.Infor(JSON.stringify(response));
                                self.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)
                                self.arrTemp = JSON.stringify(response).courses
                            },
                            complete: function() {
                                $("#loading").hide();
                            },
                        });
                    })
                }


                Infor(response) {
                    setTimeout(function() {
                        // Đoạn mã HTML bạn muốn gắn

                        // Thêm mã HTML vào cuối phần tử body
                        $("body").append(JSON.parse(response).success);

                        setTimeout(function() {
                            $(".n-sc").remove();
                            $(".n-er").remove();
                        }, 3000);
                    }, 1000);
                }
            }
        </script>
