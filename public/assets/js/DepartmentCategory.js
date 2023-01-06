$(document).ready(function(){

    $("#department_categories-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#department, #old_department, #category, #old_category').val('');
}