$(document).ready(function(){

    $("#criterias-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
    
});

function clearForm() {
    $('#category, #old_category, #sub_category, #old_sub_category, #name, #old_name, #description, #old_description').val('');
}