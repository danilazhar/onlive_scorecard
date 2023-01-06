$(document).ready(function(){

    $("#passrates-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#department, #rate, #old_rate').val('');
}