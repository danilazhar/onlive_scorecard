$(document).ready(function(){

    $("#categories-table, #department_categories-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#department, #old_department, #category, #old_category, #name, #old_name, #description, #old_description').val('');
}