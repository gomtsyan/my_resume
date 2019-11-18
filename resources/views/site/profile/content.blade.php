@if($aboutMe)
    <section class="content profile border-bottom padding-block">
        <div class="container">
            <div class="row imagetiles">
                <div class="col-xs-12 col-sm-12 col-lg-7 padding-bottom">
                    <h3 class="title">{{ $aboutMe->title ?? '' }}</h3>
                    {!! $aboutMe->text ?? '' !!}
                    @if($aboutMe->cv)
                        <p>
                            <a href="{{ route('download', $aboutMe->cv)}}" class="btn btn-color hover-animate" target="_blank">{{ __('app.download_cv') }}</a>
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-5">
                    <div class="block-grey">
                        <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.profile_path') }}/{{ $aboutMe->img ?? 'no_photo.png' }}" alt="about-me">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif