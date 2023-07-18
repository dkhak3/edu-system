<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="course-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="course-name">
                        <span class="validate"></span>
                    </div>
                    <div class="mb-3">
                        <label for="start-date" class="col-form-label">Start Date:</label>
                        <input type="datetime-local" class="form-control" id="start-date">
                        <span class="validate"></span>
                    
                    </div>
                    <div class="mb-3">
                        <label for="end-date" class="col-form-label">End Date:</label>
                        <input type="datetime-local" class="form-control" id="end-date">
                        <span class="validate"></span>
                    
                    </div>
                    <div class="mb-3">
                        <label for="description-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" cols="5"  id="description-text"></textarea>
                        <span class="validate"></span>
                    
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnEvent" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>