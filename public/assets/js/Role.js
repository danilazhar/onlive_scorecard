$(document).ready(function(){

    $("#roles-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });
});

function clearForm() {
    $('#name, #old_name, #description, #old_description').val('');
}