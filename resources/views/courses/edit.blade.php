{{-- New Lecturers --}}

<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Update Course
            </h1>
        </div>
    </div>

    {{-- Form --}}
    <form id="form-1">

        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_name">Name</label>
                    <div>
                        <input type="text" id="course-name" placeholder="Enter your name..." name="course_name"
                            value="{{ $course->name }}">
                        <span style="color: red" class="validate"></span>
                    </div>

                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_address">Start Date</label>
                    <div>
                        <input type="datetime-local" id="start-date" placeholder="Enter your address" name="startdate"
                            class="form-control" value="{{ $course->startdate }}">
                        <span style="color: red" class="validate"></span>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_phone">End Date</label>
                    <div>
                        <input type="datetime-local" id="end-date" name="enddate" class="form-control"
                            value="{{ $course->enddate }}">
                        <span style="color: red" class="validate"></span>
                    </div>

                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_birthday">Description</label>
                    <div>
                        <textarea name="decription-sc" id="decription-text" cols="70" rows="10">{{ $course->description }}</textarea>
                        <span style="color: red" class="validate"></span>
                    </div>

                </div>
            </div>
        </div>
        <button id="btnEditCourse" class="btn-primary-style " data-item="{{ $course->id }}">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Update course
        </button>
    </form>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $(window).on('popstate', function() {
            console.log(window.location.href);
            if (window.location.href == 'http://127.0.0.1:8000/courses') {
                $.ajax({
                    type: "GET",

                    url: "http://127.0.0.1:8000/api/courses/index",

                    dataType: "html",
                    success: function(response) {
                        var history = window.history || window.location.history;
                        history.pushState(null, null, `/courses`);
                        $(".coursesRender").html(response);
                    }
                });
            }

        });
        $('#course-name').keydown(function(e) {
            $(".validate:eq(0)").text("");

        });
        $('#start-date').change(function(e) {
            $(".validate:eq(1)").text("");

        });
        $('#end-date').change(function(e) {
            $(".validate:eq(2)").text("");

        });
        $('#decription-text').change(function(e) {
            $(".validate:eq(3)").text("");

        });
        $("#course-name").val('{{ $course->name }}')
        $("#start-date").val('{{ $course->startdate }}')
        $("#end-date").val('{{ $course->enddate }}')
        $("#description-text").val('{{ $course->description }}')


        $("#btnEditCourse").click(function(e) {
            e.preventDefault();
            $('.loader').attr('class', 'loader');

            $(".validate:eq(0)").text("");
            $(".validate:eq(1)").text("");
            $(".validate:eq(2)").text("");
            $(".validate:eq(3)").text("");

            $.ajax({
                url: `http://127.0.0.1:8000/api/courses/update-course/${$('#btnEditCourse').attr('data-item')}`,
                type: "PUT",
                data: {
                    name: $("#course-name").val(),
                    startdate: $("#start-date").val(),
                    enddate: $("#end-date").val(),
                    description: $("#decription-text").val(),
                },

                success: function(response) {
                    
                    Infor(response)
                    if (response.success == false) {
                        if (response.validate.name) {

                            $(".validate:eq(0)").text(response.validate.name[0]);
                        }
                        if (response.validate.startdate) {
                            $(".validate:eq(1)").text(response.validate.startdate[0]);
                        }
                        if (response.validate.enddate) {
                            $(".validate:eq(2)").text(response.validate.enddate[0]);
                        }
                        if (response.validate.description) {
                            $(".validate:eq(3)").text(
                                response.validate.description[0]
                            );
                        }
                    } else {
                        loadIndex()
                    }
                    $('.loader').attr('class', 'loader loader--hidden');

                },
            });

        });
    })

    function Infor(response) {
        setTimeout(function() {
            // Đoạn mã HTML bạn muốn gắn

            // Thêm mã HTML vào cuối phần tử body
            $("body").append(response.viewsuccess);

            setTimeout(function() {
                $(".n-sc").remove();
                $(".n-er").remove();
            }, 3000);
        }, 1000);
    }

    function loadIndex() {
        $.ajax({
            url: `http://127.0.0.1:8000/api/courses/index`,
            type: "GET",
            success: function(response) {
                var history = window.history || window.location.history;
                history.pushState(null, null, `/courses`);
                $(".coursesRender").html(response);

            },
        })
    }
</script>
