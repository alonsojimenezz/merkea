<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">@slot('title')</h3>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-light">
                Action
            </button>
        </div>
    </div>
    <div class="card-body">
        @slot('content')
    </div>
    <div class="card-footer">
        @slot('footer')
    </div>
</div>
