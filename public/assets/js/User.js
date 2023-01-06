$(document).ready(function(){
    
    $("#users-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });

});

function clearForm() {
    $('#name, #old_name, #email, #old_email, #role, #department').val('');
}