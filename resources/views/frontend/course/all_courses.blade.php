@extends('frontend.master')
@section('home')

@section('title')
Tous les cours | EduPlatform
@endsection

@php
    $courses = App\Models\Course::where('status',1)->orderBy('id','ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
    $setting = App\Models\SiteSetting::find(1);
@endphp

{{-- @php
    $setting = App\Models\SiteSetting::find(1);
@endphp --}}


<section class="course-area pb-120px">
    <div class="container">
        <div class="text-center section-heading">
            {{-- <h5 class="mb-2 ribbon ribbon-lg">Choose your desired courses</h5> --}}
            <h2 class="section__title">Liste des cours</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <ul class="pb-4 nav nav-tabs generic-tab justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab"
                    aria-controls="business" aria-selected="true">Tous</a>
            </li>
            @foreach ( $categories as $category)


            <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business{{ $category->id }}" role="tab"
                    aria-controls="business" aria-selected="false">{{ $category->category_name }}</a>
            </li>
            @endforeach
        </ul>
    </div><!-- end container -->
    <div class="card-content-wrapper bg-gray pt-50px pb-120px">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="business" role="tabpanel"
                    aria-labelledby="business-tab">
                    <div class="row">

                        @foreach ($courses as $course)


                        <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1{{$course->id}}">
                                <div class="card-image">
                                    <a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}" class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}"
                                            data-src="{ asset($course->course_image) }}" alt="Image du cours">
                                    </a>
                                    <div class="course-badge-labels">
                                        @if ($course->bestseller == 1)
                                        <div class="course-badge">Meilleure vente</div>
                                        @else
                                        @endif
                                        @if ($course->	highestrated == 1)
                                        <div class="course-badge sky-blue">Mieux noté</div>
                                        @else
                                        @endif
                                        @if ($course->featured == 1)
                                        <div class="course-badge">En vedette</div>
                                        @else
                                        @endif

                                        @php
                                            $discount = $course->selling_price - $course->discount_price;
                                            $discount_per = round($discount / $course->selling_price * 100);
                                        @endphp
                                        @if ($course->discount_price == NULL)
                                        <div class="course-badge blue">Nouveau</div>
                                        @else
                                        <div class="course-badge blue">-{{ $discount_per }}%</div>
                                        @endif

                                    </div>
                                </div><!-- end card-image -->
                                <div class="card-body">

                                    <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">{{ $course->label }}</h6>


                                    <h5 class="card-title"><a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}">{{ $course->course_name }}</a></h5>



                                    <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>

                                    <div class="py-2 rating-wrap d-flex align-items-center">
                                        @php
                                        $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->get();
                                        $avarage = App\Models\Review::where('course_id', $course->id)->where('status', 1)->avg('rating');
                                        @endphp
                                        <div class="review-stars">
                                            <span class="rating-number">{{ round($avarage,1) }}</span>
                                            @if ($avarage == 0)
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 1 || $avarage < 2)
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 2 || $avarage < 3)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 3 || $avarage < 4)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 4 || $avarage < 5)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 5 || $avarage < 5)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            @endif
                                        </div>
                                        <span class="pl-1 rating-total">({{ count( $reviewCount) }} avis)</span>
                                    </div><!-- end rating-wrap -->
                                    <div class="d-flex justify-content-between align-items-center">
                                       @if ($course->discount_price == NULL)
                                       <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                                       @else
                                       <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span
                                        class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                                       @endif


                                        {{-- wish List work  function--}}
                                        <div class="shadow-sm cursor-pointer icon-element icon-element-sm"
                                            title="Ajouter aux favoris" id="{{$course->id}}" onclick="addToWishList(this.id)" ><i class="la la-heart-o"></i>
                                        </div>


                                        {{-- wish List work  end function--}}



                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col-lg-4 -->
                        @endforeach
                    </div><!-- end row -->
                </div><!-- end tab-pane -->


                @foreach ($categories as $category)


                <div class="tab-pane fade" id="business{{ $category->id }}" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                        @php
                            $categoryWiseCourse = App\Models\Course::where('category_id', $category->id)->where('status',1)->orderBy('id','DESC')->limit(3)->get();
                        @endphp

                        @forelse ($categoryWiseCourse as $course)


                        <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_2">
                                <div class="card-image">
                                    <a href="course-details.html" class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}"
                                        data-src="images/img8.jpg" alt="Image du cours">
                                    </a>
                                </div><!-- end card-image -->

                                <div class="card-body">
                                    <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">{{ $course->label }}</h6>
                                    <h5 class="card-title"><a href="course-details.html">{{ $course->course_name }}</a></h5>
                                    <p class="card-text"><a href="teacher-detail.html">{{ $course['user']['name'] }}</a></p>



                                    <div class="py-2 rating-wrap d-flex align-items-center">
                                        <div class="review-stars">
                                            <span class="rating-number">4.4</span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                        </div>
                                        <span class="pl-1 rating-total">(20,230)</span>
                                    </div><!-- end rating-wrap -->


                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($course->discount_price == NULL)
                                        <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                                        @else
                                        <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span
                                         class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                                        @endif

                                        <div class="shadow-sm cursor-pointer icon-element icon-element-sm"
                                            title="Ajouter aux favoris"><i class="la la-heart-o"></i></div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col-lg-4 -->
                        @empty
                        <h5 class="text-danger">Aucun cours trouvé</h5>

                        @endforelse


                    </div><!-- end row -->
                </div><!-- end tab-pane -->
                @endforeach


            </div><!-- end tab-content -->

        </div><!-- end container -->
    </div><!-- end card-content-wrapper -->
</section><!-- end courses-area -->

@php
  $categoryWiseCourse = App\Models\Course::get();
 @endphp

@foreach ($categoryWiseCourse as $course)


<div class="tooltip_templates">
    <div id="tooltip_content_1{{ $course->id }}">
        <div class="card card-item">
            <div class="card-body">
                <p class="pb-2 card-text">Par <a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                <h5 class="pb-1 card-title"><a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}">{{ $course->course_name }}</a></h5>
                <div class="pb-1 d-flex align-items-center">
                    @if ($course->bestseller == 1)
                    <h6 class="mr-2 ribbon fs-14">Meilleure vente</h6>

                    @else
                    @endif
                    @if ($course->	highestrated == 1)
                    <h6 class="mr-2 ribbon fs-14">Mieux noté</h6>

                    @else
                    @endif
                    @if ($course->featured == 1)
                    <h6 class="mr-2 ribbon fs-14">En vedette</h6>

                    @else
                    @endif

                    <p class="text-success fs-14 font-weight-medium">Mis à jour le<span
                            class="pl-1 font-weight-bold">{{ $course->created_at->format('M D Y') }}</span></p>
                </div>
                <ul
                    class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>{{ $course->duration }} heures au total</li>
                    <li>{{ $course->label }}</li>
                </ul>
                {{-- <p class="pt-1 card-text fs-14 lh-22">The skills you need to become a BI Analyst - Statistics,
                    Database theory, SQL, Tableau – Everything is included</p> --}}
                <p class="pt-1 card-text fs-14 lh-22">{{ $course->prerequisites }}</p>
                    @php
                        $goals = App\Models\Course_goal::where('course_id', $course->id)->orderBy('id', 'desc')->get();
                    @endphp

                <ul class="py-3 generic-list-item fs-14">
                    @foreach ($goals as $goal)

                    <li><i class="mr-1 text-black la la-check"></i>{{ $goal->goal_name }} </li>
                    @endforeach

                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  {{-- add to cart code  --}}

                    <button type="submit" class="mr-3 btn theme-btn flex-grow-1" onclick="addToCart({{$course->id}},'{{$course->course_name}}','{{$course->instructor_id}}','{{$course->course_name_slug}}')">
                        <i class="mr-1 la la-shopping-cart fs-18"></i>
                         Ajouter au panier
                    </button>


                    {{-- wishlist code --}}
                    <div class="shadow-sm cursor-pointer icon-element icon-element-sm" title="Ajouter aux favoris" id="{{$course->id}}" onclick="addToWishList(this.id)">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div><!-- end card -->
    </div>
</div><!-- end tooltip_templates -->
@endforeach
@endsection