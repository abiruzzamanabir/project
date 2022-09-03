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
                            <input name="btn_title[]" class="form-control my-3" type="text" placeholder="Button Title">
                            <input name="btn_link[]" class="form-control my-3" type="text" placeholder="Button Link">
                            
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

        $("#add-new-vision-button").click(function (e) {
            e.preventDefault();

            $(".vision-btn-opt-area").append(`
                            <div class="btn-section">
                            <div class="d-flex justify-content-between">
                            <span>Button ${btn_no}</span>
                            <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i class="fa fa-close" aria-hidden="true"></i></span>
                            </div>
                            <input name="vision_name[]" class="form-control my-3" type="text" placeholder="Vision Name">
                            <input name="vision_desc[]" class="form-control my-3" type="text" placeholder="Vision Description">
                            </div>
                    `);
            btn_no++;
        });

        $('#percentage').change(function(){
            document.getElementById('percentage_val').value=$(this).val();
             });

        
        $('.show-icon').click(function (e) { 
            e.preventDefault();
            $('#select-icon').modal('show');
            
        });

        $('.select-icon-abir .preview-icon').click(function(){
            let icon_name = $(this).find("i").attr("class");;
            $('.select-abir-icon-input').val(icon_name);
            $('#select-icon').modal('hide');
            
        });

    });
})(jQuery);
