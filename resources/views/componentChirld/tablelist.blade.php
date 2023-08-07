@foreach ($courses as $e)
    <tr>
        <td> <input type="checkbox" data-item="{{ $e->id }}" class="checklist" name="checkall"></td>
        <td>{{ $e->name }}</td>
        <td class="mbl-none">{{ $e->description }}</td>
        <td>{{ $e->created_at }}</td>
        <td>{{ $e->startdate }}</td>
        <td>{{ $e->enddate }}</td>
        <td>
            {{--  --}}
            <div class="actions-style">
                {{-- Edit --}}
                <a href="{{ route('courses.show', $e->id) }}" class="btnEdit" data-item="{{ $e->id }}"
                    class="menu-item" data-bs-toggle="tooltip" title="Edit">
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

                <button data-bs-toggle="modal" data-item="{{ $e->id }}" class="chooseID"
                    data-bs-target="#modalDelete" title="Delete">
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
                            <input type="hidden" id="contact_id">
                            <p>You won't be able to revert this!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger deleteCourses" data-bs-dismiss="modal">Yes,
                                delete it! </button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        {{-- <td style="white-space: nowrap"><button type="button"  class="btn btnEdit btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-id="{{$e->id}}"><i class="fa-solid fa-pen"></i></button> | <button data-item="{{$e->id}}" class="btn btn-danger btnDelete"><i class="fa-solid fa-trash"></i></button></td> --}}
    </tr>
@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
    var dataCheckedArrCourses = {
        arrNotCheck: [],
        arrCourses:[],
        arrCheck:[],
        arrDeleteAllSelected: []
    }
    var chooseEL = -1;
    if (sessionStorage.getItem('arrNotCheckCourses')) {
        dataCheckedArrCourses.arrNotCheck = sessionStorage.getItem('arrNotCheckCourses').slice(1, -1).trim().split(',').map(Number)
        dataCheckedArrCourses.arrCourses = sessionStorage.getItem('arrCourses').slice(1, -1).trim().split(',').map(Number)
        dataCheckedArrCourses.arrCheck = sessionStorage.getItem('arrCheck').slice(1, -1).trim().split(',').map(Number)
        dataCheckedArrCourses.arrCourses = dataCheckedArrCourses.arrCourses.filter(function(item) {
            return !dataCheckedArrCourses.arrNotCheck.includes(item);
        });
        
        sessionStorage.setItem('arrDeleteCourses',JSON.stringify(dataCheckedArrCourses.arrCourses) )
        if (sessionStorage.getItem('checkList') =='true') {
            $('.checklist').each(function(i, e) {
            if (dataCheckedArrCourses.arrCourses.includes(parseInt($(e).attr("data-item")))) {
                $(e).prop('checked',true)
                $(e).attr('checked',true)
            }else{
                $(e).removeAttr("checked")
                $(e).prop('checked',false)
                $(e).attr('checked',false)
            }
        });
        }else{
            $('.checklist').each(function(i, e) {
            if (dataCheckedArrCourses.arrCheck.includes(parseInt($(e).attr("data-item")))) {
                $(e).prop('checked',true)
                $(e).attr('checked',true)
                console.log("check: "+$(e).attr('data-item'));
            }
        });
        }

    }

    $('.chooseID').each(function(i, el) {
        $(el).click(function(e) {
            chooseEL = $(el).attr(
                "data-item"
            )
        });
    });
    $('.checklist').each(function(i, e) {
        $(e).click(function() {
            if (!$(e).prop('checked')) { 
                const dataItem = parseInt($(e).attr("data-item"));
                dataCheckedArrCourses.arrCheck = dataCheckedArrCourses.arrCheck.filter(
                    (item) => item !== parseInt($(e).attr("data-item"))
                );
                dataCheckedArrCourses.arrNotCheck = [
                    ...dataCheckedArrCourses.arrNotCheck,
                    dataItem,
                ];
                
                sessionStorage.setItem('arrNotCheckCourses', JSON.stringify(dataCheckedArrCourses
                    .arrNotCheck)); 
                    sessionStorage.setItem('arrCheck', JSON.stringify(dataCheckedArrCourses
                    .arrCheck));

            }
            if ($(e).prop('checked')) { 
                const dataItem = parseInt($(e).attr("data-item"));
                dataCheckedArrCourses.arrNotCheck = dataCheckedArrCourses.arrNotCheck.filter(
                    (item) => item !== parseInt($(e).attr("data-item"))
                );
                dataCheckedArrCourses.arrCheck = [
                    ...dataCheckedArrCourses.arrCheck,
                    dataItem,
                ];
                sessionStorage.setItem('arrNotCheckCourses', JSON.stringify(dataCheckedArrCourses
                    .arrNotCheck)); 
                    sessionStorage.setItem('arrCheck', JSON.stringify(dataCheckedArrCourses
                    .arrCheck));

            }
           
        });
    });

    $(".deleteCourses").each(function(index, element) {
        $(element).click(function(e) {
            $.ajax({
                url: `http://127.0.0.1:8000/api/courses/delete/${chooseEL}}`,
                type: "DELETE",
                dataType: "html",
                accepts: {
                    mycustomtype: "application/x-some-l-type",
                },
                success: function(response) {
                    setTimeout(function() {
                        $("body").append(JSON.parse(response).success);
                        loadTB()
                        setTimeout(function() {
                            $(".n-sc").remove();
                            $(".n-er").remove();
                        }, 3000);
                    }, 1000);
                },
            });
        });
    });

    function loadTB() {
        $('#renderTB').html(
            '<tr><td class="loader-subject" colspan="6"></td></tr>'
        );
        $.ajax({
            url: 'http://127.0.0.1:8000/api/courses/search',
            type: "GET",
            data: {
                page: `{{ session()->get('pageCourses') }}`,
                key: `{{ session()->get('keyCourses') }}`,
                sort: `{{ session()->get('sortCourses') }}`,
            },
            dataType: "html",

            success: function(response) {
                $("#renderTB").html("");
                $("#renderTB").html(JSON.parse(response)
                    .blade);
            },
            complete: function() {
                $("#loading").hide();
            },
        });
    }
</script>
