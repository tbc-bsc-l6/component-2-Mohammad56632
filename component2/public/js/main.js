// <!-- Initialize Swiper -->
var swiper = new Swiper(".swiper-container", {
    spaceBetween: 30,
    effect: "fade",
      loop:true,
      autoplay:{
          delay:3500,
          disableOnInteraction:false,
      }
   
  });

  var swiper = new Swiper(".swiper-testimonials", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    slidesPerView: 3,
    loop:  true,
    autoplay:{
          delay:3500,
          disableOnInteraction:false,
      },
    coverflowEffect:{
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: false,
    },
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints:{
      320:{
        slidesPerView: 1,
      },
      640:{
        slidesPerView: 1,
      },
      768:{
        slidesPerView: 2,
      },
      1024:{
        slidesPerView: 3,
      },
    }
  });
                
  function alert(type, msg){
          let bs_class =(type == 'success') ? 'alert-success' : 'alert-danger';
          let element = document.createElement('div');
          element.innerHTML = `
              <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
                  <strong class="me-3">${msg}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          `;
              document.body.append(element);
      }
  
      function setActive(){
          let navbar =document.getElementById('nav-bar');
          let a_tags = navbar.getElementsByTagName('a');
          for(i=0; i<a_tags.length; i++){
              let file = a_tags[i].href.split('/').pop();
              let file_name = file.split('.')[0];
              if(document.location.href.indexOf(file_name)>=0){
                  a_tags[i].classList.add('active');
              }
          }
      }
  
          let register_form =document.getElementById('register-form');
          register_form.addEventListener('submit',(e)=>{
              e.preventDefault();
              let data = new FormData();
              data.append('name',register_form.elements['name'].value);
              data.append('email',register_form.elements['email'].value);
              data.append('phonenum',register_form.elements['phonenum'].value);
              data.append('address',register_form.elements['address'].value);
              data.append('pincode',register_form.elements['pincode'].value);
              data.append('dob',register_form.elements['dob'].value);
              data.append('pass',register_form.elements['pass'].value);
              data.append('cpass',register_form.elements['cpass'].value);
              data.append('profile',register_form.elements['profile'].files[0]);
              data.append('register','');
  
              var myModal = document.getElementById('registerModal');
              var modal = bootstrap.Modal.getInstance(myModal);
              modal.hide();
  
              let xhr = new XMLHttpRequest();
              xhr.open("POST","ajax/login_register.php",true);
              xhr.onload=function(){
                  if(this.responseText == 'pass_mismatch'){
                      alert('error','password mismatch');
                  }
                  else if(this.responseText == 'email_already'){
                      alert('error','Email is already registered');
                  }
                  else if(this.responseText == 'phone_already'){
                      alert('error','phone number is already registered');
                  }
                  else if(this.responseText == 'inv_img'){
                      alert('error','image only allow jpg and png');
                  }
                  else if(this.responseText == 'upd_failed'){
                      alert('error','Image upload failed');
                  }
                  else if(this.responseText == 'mail_failed'){
                      alert('error','Cannot send confiramtiion email! server down!');
                  }
                  else if(this.responseText == 'ins_failed'){
                      alert('error','registration failed! server donw!');
                  }
                  else{
                      alert('success','Registration successful Confirmation link sent to email!');
                      register_form.reset();
                  }
  
              }
              xhr.send(data);
  
          });
  
          setActive();
