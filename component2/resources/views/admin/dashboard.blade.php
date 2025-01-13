
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard -> @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Merienda:wght@500;700;800&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/common.css')}}">
<style>
    *{
    font-family: 'Poopins', sans-serif;
}
.h-font{
    font-family: 'Merienda',cursive;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}

/* Firefox */
/* input[type=number] {
-moz-appearance: textfield;
} */
.custom-bg{
background-color: #2ec1ad;
border: 1px solid #279e8c;
}
.custom-bg:hover{
background-color:#279e8c;
border-color: #2ec1ad;
}
.h-line{
    width: 150px;
    margin: 0 auto;
    height: 1.7px;
}
.custom-alert{
    position: fixed;
    top: 80px;
    right: 25px;

}
#dashboard-menu{
    position: fixed;
    height: 100%;
    z-index: 11;
}

@media screen and (max-width:991px){
    #dashboard-menu{
        height: auto;
        width: 100%;
    }
}
#main-content{
    margin-top: 6opx;
}
</style>

</head>

<body class="bg-light">
    <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h3 class="mb-0">ADMIN PANEL</h3>
    
        <div class="dropdown">
            <!-- Profile Image and Dropdown -->
            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Ensure the path is correct -->
                <img src="{{ asset(Auth::user()->profile) }}" alt="Profile" class="rounded-circle" width="30" height="30">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <!-- Profile Link -->
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        {{ __('Profile') }}
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        
        
    </div>
    
    
    <div class="col-lg-2 bg-dark border-top border-3 border-secondary " id="dashboard-menu">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2 text-light">ADMIN PANEL</h4>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{url('/dashboard')}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('rooms.index')}}">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('features.index')}}">Features & Facilities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('user.query.index')}}">User Queries</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('carousel.index')}}">Carousel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('admin.setting')}}">Settings</a>
                        </li>
    
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script>
    function setActive(){
        let navbar =document.getElementById('dashboard-menu');
        let a_tags = navbar.getElementsByTagName('a');
        for(i=0; i<a_tags.length; i++){
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];
            if(document.location.href.indexOf(file_name)>=0){
                a_tags[i].classList.add('active');
            }
        }
    }
    setActive();
</script>
</body>

</html>