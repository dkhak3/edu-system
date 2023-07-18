$(document).ready(function () {
    $(".ajax-link").on("click", function (e) {
        e.preventDefault();
        var url = "http://127.0.0.1:8000/api/courses/add";

        $.ajax({
            url: url,
            type: "GET",
            dataType: "html",
            success: function (response) {
                $("body").html(response);
            },
        });
    });
});
var course = {
    list: null,
};
var dataCourses = {
    keySearch: "",
    page: 1,
    sort: ''
};
var arrCourses = [];
var cheked = false;
$(function () {
    course.list = new DataList();
    course.list.load(dataCourses.page, dataCourses.keySearch,dataCourses.sort);

    course.list.checklist(arrCourses);
});
$("#checkall").click(function (e) {
    if (e.target.checked) {
        cheked = true;
        $.ajax({
            url: "http://127.0.0.1:8000/api/courses/all",
            type: "GET",

            dataType: "html",

            success: function (response) {
               
                arrCourses = JSON.parse(response).courses;

                course.list.checklist(arrCourses, cheked);
            },
        });
    } else {
        arrCourses = [];
        cheked = false;
        course.list.checklist(arrCourses, cheked);
    }
});

$("#search").keydown(function (e) {
    setTimeout(function () {
        dataCourses.keySearch = e.target.value;
        course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);
        course.list.checklist(arrCourses);
    }, 2000);
});
$(".btnAdd").click(function (e) {
    
    $("#course-name").val("");
    $("#start-date").val("");
    $("#description-text").text("");
    $("#end-date").val("");
    $("#btnEvent").text("Add");
    $(".validate:eq(0)").text("");
    $(".validate:eq(1)").text("");
    $(".validate:eq(2)").text("");
    $(".validate:eq(3)").text("");
    $(".modal-backdrop").css("display", "block");
});
var tempSort = 0
$('#sort').click(function (e) {
    if (tempSort == 0) {
        dataCourses.sort = 'increaseName'
        course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)
        
        $('#sort').attr('class', 'fa-solid fa-arrow-up-a-z');
        tempSort++
    }else{
        dataCourses.sort = 'reduceName'
        $('#sort').attr('class', 'fa-solid fa-arrow-down-a-z');
        course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)
        tempSort= 0
    }
})

$("#btnEvent").click(function (e) {
    $(".validate:eq(0)").text("");
    $(".validate:eq(1)").text("");
    $(".validate:eq(2)").text("");
    $(".validate:eq(3)").text("");
    if (e.target.textContent == "Add") {
        console.log($("#start-date").val());
        $.ajax({
            url: "http://127.0.0.1:8000/api/courses/add-course",
            type: "POST",
            data: {
                name: $("#course-name").val(),
                startdate: $("#start-date").val(),
                enddate: $("#end-date").val(),
                description: $("#description-text").val(),
            },

            success: function (response) {
                console.log(response);
                course.list.Infor(JSON.stringify(response));
                course.list.validateError(response);
                course.list.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);
            },
        });
    }
});
class DataList {
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

            success: function (response) {
                $("#renderTB").html("");
                $("#renderTB").html(JSON.parse(response).blade);
                self.arrTemp = JSON.parse(response).courses
                self.bindEvent();
                self.loadPage(JSON.parse(response), page, keySearch, sort);
                self.checklist(arrCourses, cheked);
            },
            complete: function () {
                $("#loading").hide();
            },
        });
    }
    DeleteCourses(element) {
        var self = this;

        $.ajax({
            url: `http://127.0.0.1:8000/api/courses/delete/${$(element).attr(
                "data-item"
            )}`,
            type: "DELETE",
            dataType: "html",

            accepts: {
                mycustomtype: "application/x-some-l-type",
            },
            success: function (response) {
                self.Infor(response);
                self.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort); 
            },
        });
    }
    validateError(response) {
        if (response.validate) {
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
            $(".modal").css("display", "none");
            $(".modal-backdrop").css("display", "none");
        }
    }
    checklist(arrCourses, checked) {
        var self = this
        if (checked == true) {
            $(".checklist").each(function (index, e) {
                $(e).prop("checked", true);
            });
        } else {
            $(".checklist").each(function (index, e) {
                $(e).prop("checked", false);
                $(e).attr("checked", false);
            });
        }
        $(".checklist").each(function (index, e) {
            $(e).click(function () {
                
                
               
                const check = arrCourses.includes(
                    parseInt($(e).attr("data-item"))
                );

                if (check) {
                    arrCourses = arrCourses.filter(
                        (item) => item !== parseInt($(e).attr("data-item"))
                    );
                } else  if ($(e).attr('checked'))  {
                    arrCourses = [
                        ...arrCourses,
                        parseInt($(e).attr("data-item")),
                    ];
                }

                if (self.arrTemp.length == arrCourses.length) {
                    $("#checkall").prop("checked", true);
                } else {
                    $("#checkall").prop("checked", false);
                }
                console.log(arrCourses);
            });
        });
        $('#btnAll').click(function (e) {
            console.log(arrCourses);
            $(self.container).html('<tr><td id="loading" class="loading" colspan="6"></td></tr>');
            
            $.ajax({
                url: 'http://127.0.0.1:8000/api/courses/delete/courses/all',
                type: "POST",
                data: {
                    arrCourses: arrCourses,
                },
                dataType: "html",
        
                success: function (response) {
                    self.Infor(JSON.stringify(response));
                    self.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort)
                    self.arrTemp = JSON.stringify(response).courses
                },
                complete: function () {
                    $("#loading").hide();
                },
            });
        })
    }
    loadPage(result, page, keySearch, sort) {
        var self = this;
        let rederURL = "";
        let number = 0;
        const totalPage = result.search.last_page;
        for (let i = page; i <= totalPage; i++) {
            number = i;
            if (page - 1 != 0) {
                rederURL += `<li class="rounded-circle page"><span>Pre</span></li>`;
            }
            if (page == 1) {
                rederURL += `
            <li class="rounded-circle page ${
                page == 1 ? "activeCourses" : ""
            }"><span>${1}</span></li>`;
            } else if (i - 1 > 0) {
                rederURL += `
            <li class="rounded-circle page "><span>${i - 1}</span></li>`;
            }
            if (number <= totalPage) {
                rederURL += `<li class="rounded-circle page ${
                    page != 1 ? "activeCourses" : ""
                }"><span>${page == 1 ? number + 1 : number}</span></li>`;
                if (number + 1 <= totalPage) {
                    rederURL += `<li class="rounded-circle page"><span>${
                        page == 1 ? number + 1 + 1 : number + 1
                    }</span></li>`;
                    if (number + 1 + 1 <= totalPage) {
                        rederURL += `<li class="rounded-circle page"><span>Next</span></li>`;
                    }
                }
            }
            $(".page-url").html(rederURL);
            break;
        }
        $(".page").each(function (index, element) {
            $(element).click(function () {
                if ($(element).text() == "Next") {
                    page += 1;
                    self.load(page, keySearch);
                } else if ($(element).text() == "Pre" && page - 1 != 0) {
                    page -= 1;
                    self.load(page, keySearch);
                } else {
                    page = parseInt($(element).text());

                    self.load(page, keySearch, sort);
                }
            });
        });
    }
    bindEvent() {
        var self = this;

        $(".btnDelete").each(function (index, element) {
            $(element).click(function () {
                self.DeleteCourses(element);
            });
        });
        var number = -1;

        $(".btnEdit").each(function (index, element) {
            $(element).click(function () {
                $(".modal-backdrop").css("display", "block");

                number = $(element).attr("data-id");
                const modalTitle = exampleModal.querySelector(".modal-title");
                const modalBodyInput =
                    exampleModal.querySelector(".modal-body input");
                modalTitle.textContent = `Edit Course`;
                $("#btnEvent").text("Edit");
                $.ajax({
                    url: `http://127.0.0.1:8000/api/courses/edit/show/${number}`,
                    type: "POST",

                    accepts: {
                        mycustomtype: "application/x-some-custom-type",
                    },
                    success: function (response) {
                        $("#course-name").val(response.course.name);
                        $("#start-date").val(response.course.startdate);
                        $("#end-date").val(response.course.enddate);
                        $("#description-text").text(
                            response.course.description
                        );
                    },
                });
            });
        });
        $("#course-name").keyup(function (e) { 
            $(".validate:eq(0)").text("");
        });
        $("#start-date").change(function (e) { 
            $(".validate:eq(1)").text("");
        });
        $("#end-date").change(function (e) { 
            $(".validate:eq(2)").text("");
        });
        $("#description-text").keyup(function (e) { 
            $(".validate:eq(3)").text("");
        });
        $("#btnEvent").click(function (e) {
            $(".validate:eq(0)").text("");
            $(".validate:eq(1)").text("");
            $(".validate:eq(2)").text("");
            $(".validate:eq(3)").text("");
            if (e.target.textContent == "Edit") {
                console.log($("#start-date").val());
                $.ajax({
                    url: `http://127.0.0.1:8000/api/courses/update-course/${number}`,
                    type: "PUT",
                    data: {
                        name: $("#course-name").val(),
                        startdate: $("#start-date").val(),
                        enddate: $("#end-date").val(),
                        description: $("#description-text").val(),
                    },

                    success: function (response) {
                        console.log(response);
                        self.Infor(JSON.stringify(response));
                        self.validateError(response);
                        self.load(dataCourses.page, dataCourses.keySearch, dataCourses.sort);
                    },
                });
            }
        });
        //delete all
       
    }
    Infor(response) {
        setTimeout(function () {
            // Đoạn mã HTML bạn muốn gắn

            // Thêm mã HTML vào cuối phần tử body
            $("body").append(JSON.parse(response).success);

            setTimeout(function () {
                $(".n-sc").remove();
                $(".n-er").remove();
            }, 3000);
        }, 1000);
    }
}
