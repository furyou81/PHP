var ft_list = document.getElementById("ft_list");
var c = 0;
function ft_loadCookie()
{
    var cookies = document.cookie;
    var c = cookies.split(";");
    var maxId = 0;
    for (var i = 0; i < c.length; i++)
    {
        var tmp = c[i].trim().split("=");
        if (Number.isInteger(parseInt(tmp[0])))
        {
            if (tmp[0] > maxId)
                maxId = tmp[0];
            loadDiv(tmp[0], tmp[1]);
        }
    }
    setCookie("maxId", maxId, 30);
}
c = parseInt(getCookieByName("maxId")) + 1;
if (Number.isNaN(c))
    c = 0;
function getCookieByName(name)
{
    var cookies = document.cookie;
    var c = cookies.split(";");
    for (var i = 0; i < c.length; i++)
    {
        var tmp = c[i].trim().split("=");
        if (tmp[0] == name)
            return (tmp[1]);
    }
    return ("");
}

function loadDiv(id, txt)
{
        var newDiv = document.createElement("div");
        newDiv.setAttribute("id", id);
        newDiv.setAttribute("onclick", "removeElem(this);");
        var newContent = document.createTextNode(txt);
        newDiv.appendChild(newContent);
        ft_list.insertBefore(newDiv, ft_list.firstChild);
} 
function newElem()
{
    var elem = prompt("Nouveau to do:", "");
    if (elem != "")
    {
        var newDiv = document.createElement("div");
        newDiv.setAttribute("id", c);
        newDiv.setAttribute("onclick", "removeElem(this);");
        var newContent = document.createTextNode(elem);
        newDiv.appendChild(newContent);
        ft_list.insertBefore(newDiv, ft_list.firstChild);
        setCookie(c, elem, 30);
        setCookie("maxId", c, 30);
        c++;
    }
}

function removeElem(t)
{
    if (confirm("Voulez-vous supprimer cet element de la to do?"))
    {
        var d = new Date();
        d.setTime(d.getTime() - (30 * 24 * 60 * 60 * 1000));
        document.cookie = t.id + "=;expire=" + d.toUTCString() + ";path=/";
        t.remove();
    }
}

function setCookie(cname, cvalue, exdays)
{
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    document.cookie = cname + "=" + cvalue + ";" + "expires=" + d.toUTCString() + ";path=/";
}