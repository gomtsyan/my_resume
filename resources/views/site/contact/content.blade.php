@if($contacts)
    <section class="content contact padding-block border-bottom">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-lg-6 padding-bottom">
                    <h3 class="title title-contact">{{ __('app.contact_info') }}</h3>
                    <div class="block-grey">
                        <table>
                            @if(is_object($contacts) || is_array($contacts))
                                @foreach($contacts as $contact)
                                    @if(!$contact->is_social)
                                        <tr>
                                            <td class="font-weight-m width-td contact-name">
                                                <span class="icon hidden-xs"><i class="{{ $contact->icon ?? '' }}"></i></span>  {{ $contact->name ?? '' }}
                                            </td>
                                            <td>{{ $contact->value ?? '' }}</td>
                                        </tr>
                                    @endif

                                @endforeach
                            @endif
                        </table>
                        <div class="social">
                            <ul class="animated" data-animation="fadeIn" data-animation-delay="600">
                                @if(is_object($contacts) || is_array($contacts))
                                    @foreach($contacts as $contact)
                                        @if($contact->is_social)
                                            <li>
                                                <a class="social-icons {{ $contact->name ?? '' }} hover-animate"
                                                   href="{{ $contact->value ?? '' }}"
                                                   target="_blank"
                                                >
                                                   <i class="{{ $contact->icon ?? '' }}"></i>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-lg-6">
                    <h3 class="title title-contact">{{ __('app.contact_form') }}</h3>
                    <div class="contact-form">
                        <form action="{{ route('contact_me') }}" id="contact-form" method="post">
                            <input type="text" class="{{ $errors->contactMe->has('name') ? 'error' : '' }}" id="user-name" name="name" value="{{ old('name') }}" placeholder="{{ __('app.name') }}"/>
                            <div class="error-message">{{ $errors->contactMe->first('name') }}</div>

                            <input type="email" class="{{ $errors->contactMe->has('email') ? 'error' : '' }}" id="user-email" name="email" value="{{ old('email') }}" placeholder="{{ __('app.email') }}"/>
                            <div class="error-message">{{ $errors->contactMe->first('email') }}</div>

                            <textarea id="user-message" class="{{ $errors->contactMe->has('message') ? 'error' : '' }}" name="message" placeholder="{{ __('app.message') }}">{{ old('message') }}</textarea>
                            <div class="error-message">{{ $errors->contactMe->first('message') }}</div>

                            <div class="footer-form">
                                <input type="submit" id="submit-btn" class="btn btn-color hover-animate"
                                       value="{{ __('app.send_message') }}"/>

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
    </section>
@endif