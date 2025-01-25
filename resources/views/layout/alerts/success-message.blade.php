@if(session('success'))
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <i class="fa fa-solid fa-check mb-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
