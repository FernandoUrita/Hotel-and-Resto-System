let add_s_form = document.getElementById('add_s_form');

add_s_form.addEventListener('submit',function(e)
{
    e.preventDefault();
    add_add();
});

function get_adds()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/in.php",true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function(){
        document.getElementById('add-data').innerHTML = this.responseText;
    }

    xhr.send('get_adds');
}

window.onload = function(){
    get_adds();
}
