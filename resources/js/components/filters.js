$(document).ready(function(){
    $("#filters :input").change(function(e) {
        var form = $(this).closest("form");
        form.find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        form.submit();
    });
});