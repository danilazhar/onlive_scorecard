$(document).ready(function(){

    $("#department_subcategories-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#department, #old_department, #sub_category, #old_sub_category').val('');
}