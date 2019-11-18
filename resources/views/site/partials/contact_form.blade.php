<div class="style-open-form animated hi-icon-effect-8">
    <i class="hi-icon fa fa-envelope ukie-icons hover-animate hi-icon-mobile"></i>
</div>
<div class="style-contact-form {{ (session('status') || count($errors->contactMe) > 0) ? '' : 'style-off-form' }} ">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-12 ">
            <div class="contact-form">
                <div class="btn-close-form">
                </div>
                <h3 class="title title-contact">{{ __('app.contact_me') }}</h3>
                <p>{{ __('app.contact_form_text') }}</p>

                <form action="{{ route('contact_me') }}" id="contact-form-panel" method="post">
                    <input type="text" class="{{ $errors->contactMe->has('name') ? 'error' : '' }}" id="user-name-panel" name="name" value="{{ old('name') }}" placeholder="{{ __('app.name') }}" />
                    <div class="error-message">{{ $errors->contactMe->first('name') }}</div>

                    <input type="email" class="{{ $errors->contactMe->has('email') ? 'error' : '' }}" id="user-email-panel" name="email" value="{{ old('email') }}" placeholder="{{ __('app.email') }}" />
                    <div class="error-message">{{ $errors->contactMe->first('email') }}</div>

                    <textarea id="user-message-panel" class="{{ $errors->contactMe->has('message') ? 'error' : '' }}" name="message" placeholder="{{ __('app.message') }}">{{ old('message') }}</textarea>
                    <div class="error-message">{{ $errors->contactMe->first('message') }}</div>

                    <div class="footer-form">
                        <input type="submit" id="submit-btn-panel" class="btn btn-color hover-animate"  value="{{ __('app.send_message') }}" />

                        @if(session('status'))
                            <div class="info-message-form success">
                                <i class="fa fa-check-circle"></i>
                                <p>{{ session('status') }}</p>
                                <span class="close-msg"><i class="fas fa-times"></i></span>
                            </div>
                        @endif

                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>