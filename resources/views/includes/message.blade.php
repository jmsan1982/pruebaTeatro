@if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
@if(session('messageWrong'))
    <div class="alert alert-danger">
        {{ session('messageWrong') }}
    </div>
@endif
