(function($){
$(document).ready(function () {
    $('.delete-form').submit(function (e) { 
        
        let conf = confirm('Are you sure?');
        
        if (conf) {
            return true;
        } else {
            e.preventDefault();
        }
        
    });
});
})(jQuery)