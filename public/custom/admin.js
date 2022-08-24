(function ($) {
    $(document).ready(function () {
        $(".delete-form").submit(function (e) {
            let conf = confirm("Are you sure?");

            if (conf) {
                return true;
            } else {
                e.preventDefault();
            }
        });
        $("#dataTable").DataTable();

        $("#slider-photo").change(function (e) {
            const photo_url = URL.createObjectURL(e.target.files[0]);
            $("#slider-photo-preview").attr("src", photo_url);
        });

        let btn_no = 1;

        $("#add-new-slider-button").click(function (e) {
            e.preventDefault();

            $(".btn-opt-area").append(`
                            <div class="btn-section">
                            <div class="d-flex justify-content-between">
                            <span>Button ${btn_no}</span>
                            <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i class="fa fa-close" aria-hidden="true"></i></span>
                            </div>
                            <input name="btn_title[]" class="form-control my-3" type="text" placeholder="Button Link">
                            <input name="btn_link[]" class="form-control my-3" type="text" placeholder="Button Title">
                            
                            <select class="form-control my-3" name="btn_type[]">
                            <option value="btn-light-out">Default</option>
                            <option value="btn-color btn-full">Red</option>
                            </select>
                            </div>
                    `);
            btn_no++;
        });

        $(document).on("click", ".remove-btn", function () {
            $(this).closest(".btn-section").remove();
        });
    });
})(jQuery);
