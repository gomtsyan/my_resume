@if($personalInfo)
    <section class="home-header border-bottom padding-block">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5 col-lg-5 text-center border-right">
                    <div class="foto">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ $personalInfo->img ?? 'photo.png' }}" alt="avatar">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-7 col-lg-7 text-center">
                    <h1 class="title">{{ $personalInfo->full_name ?? '' }}</h1>
                    <h3 class="sub-title">{{ $personalInfo->position ?? '' }}</h3>

                    @if($contacts && is_object($contacts))
                        <div class="social">
                            <ul class="animated" data-animation="fadeIn" data-animation-delay="600">
                                @foreach($contacts as $contact)
                                    <li>
                                        <a class="social-icons {{ $contact->name ?? '' }} hover-animate"
                                           href="{{ $contact->value ?? '' }}"
                                           target="_blank">
                                            <i class="{{ $contact->icon ?? '' }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endif
