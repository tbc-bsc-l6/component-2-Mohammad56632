
let contacts_s_form = document.getElementById('contacts_s_form');
let carousel_picture_inp_inp = document.getElementById('carousel_picture_inp');

carousel_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData(); // all data store or append
    data.append('picture',carousel_picture_inp.files[0]);
    data.append('add_image', ''); //index value null

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.onload = function () {
        var myModal = document.getElementById('carousel-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();
        //console.log(this.responseText);
        if (this.responseText == 'inv_img') {
            alert('error', 'Only JPG and PNG images are allowed');
        }
        else if(this.responseText == 'inv_size') {
            alert('error', 'Image should be less than 2MB');
        }
        else if(this.responseText == 'upd_failed') {
            alert('error', 'Image upload failed server down!!');
        }
        else {
            alert('success', 'New image added');
            carousel_picture_inp.value = '';
            get_carousel(); // function call because page without refres data show !!!
        }
        
    }
    xhr.send(data);
}

function get_carousel() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        document.getElementById('carousel-data').innerHTML = this.responseText;
    }
    xhr.send('get_carousel');
}

function rem_image(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if(this.responseText==1){
            alert('success','image removed!!');
            get_carousel();
        }
        else{
            alert('error','server down!!');
        }
    }
    xhr.send('rem_image='+val);
}

window.onload = function () {
    get_carousel();


} 