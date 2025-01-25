@if (session()->has('message'))
    
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <i class="fa-solid fa-triangle-exclamation mb-2"></i> {{ session()->get('message') }}
    </div>

@endif