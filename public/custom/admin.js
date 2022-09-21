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

        $("#percentage").change(function () {
            document.getElementById("percentage_val").value = $(this).val();
        });

        $(".show-icon").click(function (e) {
            e.preventDefault();
            $("#select-icon").modal("show");
        });

        $(".select-icon-abir .preview-icon").click(function () {
            let icon_name = $(this).find("i").attr("class");
            $(".select-abir-icon-input").val(icon_name);
            $("#select-icon").modal("hide");
        });
        $("#portfolio-gallery").change(function (e) {
            const files = e.target.files;
            let gallery_ui = "";
            for (let i = 0; i < files.length; i++) {
                const gallery = URL.createObjectURL(files[i]);
                gallery_ui += `<img src="${gallery}">`;
            }
            $('.port-gall').append(gallery_ui);
        });

        CKEDITOR.replace('portfolio-desc');
        $('.js-example-basic-multiple').select2();

        $('#post-type-selector').change(function () { 
            const type = $(this).val();

            if (type=='standard') {
                $('.post-standard').show();
                $('.post-gallery').val('');
                $('.post-gallery').hide();
                $('.post-video').hide();
                $('.post-audio').hide();
                $('.post-quote').hide();
            }
            if (type=='gallery') {
                $('.post-standard').hide();
                $('.post-gallery').show();
                $('.post-video').hide();
                $('.post-audio').hide();
                $('.post-quote').hide();
            }
            if (type=='video') {
                $('.post-standard').hide();
                $('.post-gallery').hide();
                $('.post-video').show();
                $('.post-audio').hide();
                $('.post-quote').hide();
            }
            if (type=='audio') {
                $('.post-standard').hide();
                $('.post-gallery').hide();
                $('.post-video').hide();
                $('.post-audio').show();
                $('.post-quote').hide();
            }
            if (type=='quote') {
                $('.post-standard').hide();
                $('.post-gallery').hide();
                $('.post-video').hide();
                $('.post-audio').hide();
                $('.post-quote').show();
            }
            
        });
    });
})(jQuery);
