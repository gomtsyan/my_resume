@if($portfolios && is_object($portfolios))
    <div class="portfolio-section padding-block">
        <div class="container">
            <div class="row">
                <div class="portfolio">
                    <div id="portfolio-grid">

                        @foreach($portfolios as $portfolio)
                            <div class="mix col-xs-12 col-sm-6 col-lg-4 portfolio-item" data-value="{{ $portfolio->id ?? '' }}">
                                <div class="within">

                                    <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.portfolio_path') }}/{{ $portfolio->img->medium ?? 'p-1.png' }}" alt="{{ $portfolio->title ?? 'Portfolio' }}">
                                    <div class="port-item-cont">
                                        <h3 class="title">{{ $portfolio->title ?? '' }}</h3>
                                        <p class="desc">{{ $portfolio->short_desc ?? '' }}</p>
                                        <a class="fancybox popup-content view-work hover-animate" href="#work-{{ $portfolio->id ?? '' }}" rel="mygallery">{{ __('app.view_details') }}</a>
                                    </div>

                                    <div class="hidden">
                                        <div class="podrt-desc" id="work-{{ $portfolio->id ?? '' }}">
                                            <div class="modal-box-content">
                                                <img src="{{ asset(config('settings.theme')) }}/{{ config('settings.image_path') }}/{{ config('settings.portfolio_path') }}/{{ $portfolio->img->large ?? 'p_b-1.png' }}" alt="{{ $portfolio->title ?? 'Portfolio' }}">
                                                <div class="text">
                                                    <h3 class="title">{{ $portfolio->title ?? '' }}</h3>
                                                    <table>
                                                        <tr>
                                                            <td class="font-weight-m width-td">{{ __('framework') }}</td>
                                                            <td>{{ $portfolio->framework ?? '' }}</td>
                                                        </tr>
                                                    </table>
                                                    <p>{{ $portfolio->text ?? '' }}</p>
                                                    <a href="{{ $portfolio->link ?? '' }}" class="btn btn-color" target="_blank">{{ __('app.see_live') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endif