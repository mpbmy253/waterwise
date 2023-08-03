
@if (!empty(session('success')))
    <div class="alert alert-success alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('payment-error')))
    <div class="alert alert-danger alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('payment-error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('warning')))
    <div class="alert alert-warning alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('warning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('info')))
    <div class="alert alert-danger alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('info')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('secondary')))
    <div class="alert alert-secondary alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('secondary')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('primary')))
    <div class="alert alert-primary alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('primary')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if (!empty(session('light')))
    <div class="alert alert-light alert-dismissible fade show" style="font-size: 1.5rem;" role="alert">
        {{session('light')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif
