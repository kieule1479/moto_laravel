@if (session('zvn_notify'))
    <div class="row" id="tat">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="alert alert-success alert-dismissible {{-- fade in --}}" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                        aria-hidden="true">x</span></button>
                <strong>{{ session('zvn_notify') }}</strong>
            </div>
        </div>
    </div>

@endif
