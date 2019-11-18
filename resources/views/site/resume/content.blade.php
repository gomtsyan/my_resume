<section class="skills border-bottom padding-block">
    <div class="container">
        <div class="row">
            @if($languageSkills && is_object($languageSkills) && $languageSkills->count() > 0)
                <div class="col-xs-12 col-sm-12 col-lg-4 language-skills">
                    <h3 class="title title-skills">{{ __('app.language_skills') }}</h3>
                    @foreach($languageSkills as $languageSkill)
                        <div class="progress">
                            <label class="progress-bar-label">{{ $languageSkill->name ?? '' }}</label>
                            <span class="ratyli" data-rate="{{ $languageSkill->rating ?? '' }}" data-ratemax="{{ $languageSkill->max_rating ?? '' }}"></span>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-lg-8 professional-skills">
                @if($skillCategories && is_object($skillCategories) && $skillCategories->count() > 0)
                    <h3 class="title title-skills">{{ __('app.professional_skills') }}</h3>
                    <div class="filter_div controls">
                        <div class="col-xs-12 col-sm-12 col-lg-12">
                            <ul>
                                <li class="hover-animate filter" data-filter="all">{{ __('app.all') }}</li>
                                @foreach($skillCategories as $skillCategorie)
                                    <li class="hover-animate filter" data-filter=".category-{{ $skillCategorie->id ?? '' }}">{{ $skillCategorie->title ?? '' }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if($skills && is_object($skills))
                        <div class="col-xs-12 col-sm-12 col-lg-12" id="skills-grid">
                            @foreach($skills as $skill)
                                <div class="mix skill skills-item label-success category-{{ $skill->category_id ?? '' }}">{{ $skill->title ?? '' }}</div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>

<section id="resume" class="section padding-block">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="timeline">

                    @if($timeLineExperiences && is_array($timeLineExperiences))
                        @if(count($timeLineExperiences['left']) > 0 || count($timeLineExperiences['right']) > 0)
                            <!-- Experience -->
                            <div class="timeline-category exp-category">
                                <a class="large bt-timeline">{{ __('app.experiences') }}</a>
                                <div class="timeline-category-icon">
                                    <div class="iconspace"><i class="fas fa-laptop-code"></i></div>
                                </div>
                            </div>
                            <!-- Experience Timeline -->
                        @endif
                        @foreach($timeLineExperiences as $side => $experienceSideItems)
                            <div class="col-md-6 timeline-post-{{ $side }}">
                                @if($experienceSideItems && is_array($experienceSideItems))
                                    @foreach($experienceSideItems as $experienceItems)
                                        <div class="timeline-post">
                                            <div class="timeline-post-content-holder">
                                                <div class="timeline-post-icon"></div>
                                                <div class="timeline-post-title">
                                                    <h4>{{ $experienceItems->position ?? '' }}</h4>
                                                </div>
                                                <div class="timeline-post-subtitle">
                                                    <p><span>{{ $experienceItems->location ?? '' }} </span></p>
                                                </div>
                                                <div class="timeline-post-subtitle">
                                                    <p><span>{{ $experienceItems->company ?? '' }} </span><span class="timeline-separator">{{ $experienceItems->duration ?? '' }}</span></p>
                                                </div>
                                                <div class="timeline-post-content">
                                                    <p>{{ $experienceItems->description ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <!-- Experience Timeline  end -->

                    <!-- Experience mobile version -->
                    @if($experiences && is_object($experiences))
                        <div class="col-md-6 timeline-post-mobile">
                            @foreach($experiences as $key => $experience)
                                <div class="timeline-post">
                                    <div class="timeline-post-content-holder">
                                        <div class="timeline-post-icon"></div>
                                        <div class="timeline-post-title">
                                            <h4>{{ $experience->position ?? '' }}</h4>
                                        </div>
                                        <div class="timeline-post-subtitle">
                                            <p><span>{{ $experience->location ?? '' }} </span></p>
                                        </div>
                                        <div class="timeline-post-subtitle">
                                            <p><span>{{ $experience->company ?? '' }} </span><span class="timeline-separator">{{ $experience->duration ?? '' }}</span></p>
                                        </div>
                                        <div class="timeline-post-content">
                                            <p>{{ $experience->description ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <!-- Experience mobile version end -->
                    <!-- Experience end -->

                    @if($timeLineEducations && is_array($timeLineEducations))
                        @if(count($timeLineEducations['left']) > 0 || count($timeLineEducations['right']) > 0)
                            <!-- Education -->
                            <div class="timeline-category edu-cagegory">
                                <a class="large bt-timeline">{{ __('app.education') }}</a>
                                <div class="timeline-category-icon">
                                    <div class="iconspace"><i class="fas fa-graduation-cap"></i></div>
                                </div>
                            </div>
                            <!-- Education Timeline -->
                        @endif
                        @foreach($timeLineEducations as $side => $educationSideItems)
                            <div class="col-md-6 timeline-post-{{ $side }}">
                                @if($educationSideItems && is_array($educationSideItems))
                                    @foreach($educationSideItems as $educationItems)
                                        <div class="timeline-post">
                                            <div class="timeline-post-content-holder">
                                                <div class="timeline-post-icon"></div>
                                                <div class="timeline-post-title">
                                                    <h4>{{ $educationItems->institution ?? '' }}</h4>
                                                </div>
                                                <div class="timeline-post-subtitle">
                                                    <p><span>{{ $educationItems->duration ?? '' }}</span></p>
                                                </div>
                                                <div class="timeline-post-subtitle">
                                                    <p><span>{{ $educationItems->location ?? '' }} </span></p>
                                                </div>
                                                <div class="timeline-post-subtitle">
                                                    <p><span> {{ $educationItems->degree ?? '' }} </span><span class="timeline-separator">{{ $educationItems->specialization ?? '' }}</span></p>
                                                </div>
                                                <div class="timeline-post-content">
                                                    <p>{{ $educationItems->description ?? '' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <!-- Education Timeline -->
                    <!-- Education mobile version -->
                    @if($educations && is_object($educations))
                        <div class="col-md-6 timeline-post-mobile">
                            @foreach($educations as $education)
                                <div class="timeline-post">
                                    <div class="timeline-post-content-holder">
                                        <div class="timeline-post-icon"></div>
                                        <div class="timeline-post-title">
                                            <h4>{{ $education->institution ?? '' }}</h4>
                                        </div>
                                        <div class="timeline-post-subtitle">
                                            <p><span>{{ $education->duration ?? '' }}</span></p>
                                        </div>
                                        <div class="timeline-post-subtitle">
                                            <p><span>{{ $education->location ?? '' }} </span></p>
                                        </div>
                                        <div class="timeline-post-subtitle">
                                            <p><span> {{ $education->degree ?? '' }} </span><span class="timeline-separator">{{ $education->specialization ?? '' }}</span></p>
                                        </div>
                                        <div class="timeline-post-content">
                                            <p>{{ $education->description ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <!-- Education mobile version end -->
                    <!-- Education end -->
                    @if(
                        count($timeLineEducations['left']) > 0 ||
                        count($timeLineEducations['right']) > 0 ||
                        count($timeLineExperiences['left']) > 0 ||
                        count($timeLineExperiences['right']) > 0
                    )
                        <div class="timeline-end-icon">
                            <span> <i class="fa fa-bookmark"></i></span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>