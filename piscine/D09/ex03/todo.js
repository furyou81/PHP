var id_val = 0;
function newReq()
{
    var req = null;
    if (window.XMLHttpRequest)
    req = new XMLHttpRequest();
    return (req);
}

$(document).ready( function() {
        $.ajax({
            type: 'GET',
            url: 'select.php',
            data: 'id=testdata',
            dataType: 'json',
            cache: false,
            success: function(result) {
                result.forEach(element => {
                    var tmp = element.split(";")
                    if (Number.isInteger(parseInt(tmp[0])))
                        $("#ft_list").append('<div onclick="removeElem(this);" id="' + tmp[0] +'">' + tmp[1] + '<div>');
                    else if (tmp[0] == "maxVal")
                        id_val = parseInt(tmp[1]) + 1;                   
                });
            },
        });
});

function loadDiv(id, txt)
{
        var newDiv = document.createElement("div");
        newDiv.setAttribute("id", id);
        newDiv.setAttribute("onclick", "removeElem(this);");
        var newContent = document.createTextNode(txt);
        newDiv.appendChild(newContent);
        ft_list.insertBefore(newDiv, ft_list.firstChild);
}

$("#newbut").on('click', function()
{
    var todo_val = prompt("Nouveau to do:", "");
    if (todo_val != "")
    {
        $("#ft_list").prepend('<div onclick="removeElem(this);" id="' + id_val +'">' + todo_val + '<div>');
       $.ajax({
           type: "GET",
           url: "insert.php",
           data: {id:id_val, todo:todo_val, maxVal:id_val}
           }).done(function(result){
        });
        
        id_val++;
    }
});

function removeElem(t)
{
    if (confirm("Voulez-vous supprimer cet element de la to do?"))
    {
        $.ajax({
            type: "GET",
            url: "delete.php",
            data: {id:t.id}
            }).done(function(result){

                t.remove();
         });
    }
}