{{-- <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-outline rounded-pill"><i class="bi bi-list-stars"></i> List</a> --}}
<a href="{{ route('homeP') }}" class="btn btn-outline rounded-pill"><i class="bi bi-house-door-fill"></i> Home</a>
<a href="{{ route('showSite') }}" class="btn btn-outline rounded-pill"><i class="bi bi-house-door-fill"></i> ShowSite</a>

{{-- <a href="{{ route('users.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-person-fill"></i> Users</a> --}}
<a href="{{ route('categories') }}" class="btn btn-outline rounded-pill"><i class="bi bi-kanban"></i> Projects</a>
<a href="{{ route('my_project') }}" class="btn btn-outline rounded-pill"><i class="bi bi-kanban"></i> My Projects</a>
{{-- <a href="" class="btn btn-outline rounded-pill"><i class="bi bi-kanban-fill"></i> Projects Details</a> --}}
<a href="{{ route('cart') }}" class="btn btn-outline rounded-pill"><i class="bi bi-person-lines-fill"></i> cart (<livewire:frontend.cart.cart-count>)</a>
{{-- <a href="" class="btn btn-outline rounded-pill"><i class="bi bi-person-fill-check"></i> Producers</a> --}}
<a href="{{ route('watchlist.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-chat-right-text-fill"></i> watchlist (<livewire:frontend.watchlist-count>)</a>
<a href="{{ route('Report') }}" class="btn btn-outline rounded-pill"><i class="bi bi-chat-right-text-fill"></i> Reports</a>

 <style>
    .btn-outline{
        border-color: #008b8b;
        color: #008b8b;
    }

    .btn-outline:hover {
        background-color: #008b8b;
        color: #f0f6f6;
    }
 </style>
