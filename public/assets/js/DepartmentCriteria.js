$(document).ready(function(){

    $("#department_criterias-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#department, #old_department, #subcategory, #old_subcategory, #criteria, #old_criteria, #guidelines, #old_guidelines').val('');
    $('#points').val(0);
}