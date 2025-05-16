let add_s_form = document.getElementById('add_s_form');

add_s_form.addEventListener('submit',function(e)
{
    e.preventDefault();
    add_add();
});

function add_add()
{
    let data = new FormData();
    data.append('name',add_s_form.elements['add_name'].value);
    data.append('type',add_s_form.elements['add_type'].value);
    data.append('roomnum',add_s_form.elements['add_roomnum'].value);
    data.append('payment',add_s_form.elements['add_payment'].value);
    data.append('in',add_s_form.elements['add_in'].value);
    data.append('add_add','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/in.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('add-s');
        var modal = bootstrap.Modal.getInstance(myModal); // Returns a Bootstrap modal instance
        modal.hide();

        if(this.responseText == 0){
            alert('success','Checkined!');
            add_s_form.elements['add_name'].value='';
            add_s_form.elements['add_type'].value='';
            add_s_form.elements['add_roomnum'].value='';
            add_s_form.elements['add_payment'].value='';
            add_s_form.elements['add_in'].value='';
            get_features();
        }
        else{
            alert('error','Server down!');
        }
    }

    xhr.send(data);
}

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

function rem_add(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/in.php",true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function(){
        if(this.responseText==1){
            alert('success','Check-Out!');
            get_adds();
        }
        else if(this.responseText == 'room_added'){
            alert('error','Someone is check-in this room!')
        }
        else{
            alert('error', 'Server down!');
        }
    }
    
    xhr.send('rem_add='+val);
}


window.onload = function(){
    get_adds();
}
