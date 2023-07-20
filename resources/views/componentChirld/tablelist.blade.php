@foreach ($courses as $e)
    <tr>
        <td> <input type="checkbox" data-item="{{ $e->id }}" class="checklist" name="checkall"></td>
        <td>{{ $e->name }}</td>
        <td class="mbl-none">{{ $e->description }}</td>
        <td class="mbl-none">{{ $e->created_at }}</td>
        <td class="mbl-none">{{ $e->startdate }}</td>
        <td class="mbl-none">{{ $e->enddate }}</td>
        <td>

            <div class="actions-style">
                {{-- Edit --}}
                <a class="btnEdit" data-item="{{ $e->id }}" class="menu-item" data-bs-toggle="tooltip"
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

                <button class="deleteCourses" data-item="{{ $e->id }}" data-bs-toggle="tooltip" title="Delete">
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
        {{-- <td style="white-space: nowrap"><button type="button"  class="btn btnEdit btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-id="{{$e->id}}"><i class="fa-solid fa-pen"></i></button> | <button data-item="{{$e->id}}" class="btn btn-danger btnDelete"><i class="fa-solid fa-trash"></i></button></td> --}}
    </tr>
@endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
    $(".btnEdit").each(function(index, element) {
        $(element).click(function(e) {
            e.preventDefault();
            var history = window.history || window.location.history;
            history.pushState(null, null, `courses/edit/show/${$(element).attr('data-item')}`);


            $.ajax({
                url: `http://127.0.0.1:8000/api/courses/edit/show/${$(element).attr('data-item')}`,
                type: "POST",
                dataType: "html",


                success: function(response) {
                    $('.coursesRender').html(response);

                },
            });
        });
    });
    
    $(".deleteCourses").each(function(index, element) {
        $(element).click(function(e) {

            $.ajax({
                url: `http://127.0.0.1:8000/api/courses/delete/${$(element).attr(
                "data-item"
            )}`,
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
    function loadTB(){
        $('#renderTB').html(
                            '<tr><td id="loading" class="loading" colspan="6"></td></tr>'
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

                                // self.bindEvent();
                                // self.loadPage(JSON.parse(response), page, keySearch, sort);
                            },
                            complete: function() {
                                $("#loading").hide();
                            },
                        });
    }
</script>
