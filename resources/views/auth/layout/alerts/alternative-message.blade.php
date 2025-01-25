@if (session()->has('message'))
    
    <div class="alert">
        <i class="fa-solid fa-triangle-exclamation mb-2"></i> {{ session()->get('message') }}
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>

@endif