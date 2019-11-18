@if(session('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="successHandler alert alert-success">
                <button data-dismiss="alert" class="close">
                    &times;
                </button>
                <strong><i class="fas fa-check-circle"></i></strong> {{ session('success') }}
            </div>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="row">
        <div class="col-md-12">
            <div class="errorHandler alert alert-danger">
                <button data-dismiss="alert" class="close">
                    &times;
                </button>
                <strong><i class="fa fa-exclamation-triangle"></i></strong>
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif