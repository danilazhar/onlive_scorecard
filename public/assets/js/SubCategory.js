$(document).ready(function(){

    $("#sub_categories-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#category, #old_category, #name, #old_name, #description, #old_description').val('');
}