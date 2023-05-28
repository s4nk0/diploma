<x-app-layout>
    <article>



            <section class="card mb-3 border-grey">
                <div class="card-header bg-white border-bottom-0 d-flex justify-content-between">
                    <h3>{{$search_ad->location}}</h3>
                    @can('update',$search_ad)
                    <div><a href="{{route('user.search_ad.edit',['search_ad'=>$search_ad])}}" title="Редактировать" class="btn btn-primary"><i class="bi bi-pencil"></i></a></div>
                    @endif
                </div>
                <div class="row g-0">
                    <div class="col-md-6">
                        <div id="carouselIndicators" class="carousel slide mb-3" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @if($search_ad->getMedia('images')->count())
                                    @foreach($search_ad->getMedia('images') as $key => $image)
                                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="{{$key}}" @if($key == 0) class="active" aria-current="true" @endif aria-label="Slide {{$key}}"></button>
                                    @endforeach
                                @endif
                            </div>
                            <div class="carousel-inner">
                                @if($search_ad->getMedia('images')->count())
                                    @foreach($search_ad->getMedia('images') as $key => $image)
                                        <div class="carousel-item @if($key == 0) active @endif">
                                            <img src="{{$image->getFullUrl()}}" class="d-block w-100 img-fluid object-fit-contain" alt="..." style="min-height: 470px">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img src="{{$search_ad->user->profile_photo_url}}" class="d-block w-100 img-fluid object-fit-contain" alt="..." style="min-height: 470px">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        @if($search_ad->description)
                            <article class="p-3">
                                <section>
                                    <h4>Описание</h4>
                                    <p>
                                        {{$search_ad->description}}
                                    </p>
                                </section>
                            </article>

                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <article>
                                <section>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h5 class="card-title">Ищу сожителя</h5>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <b>{{$search_ad->price}} ₸</b>
                                            @if($search_ad->price_com)
                                                <div>Ком. услугу {{$search_ad->price_com}} ₸</div>
                                            @endif
                                            @if($search_ad->price_pledge)
                                                <div>Залог {{$search_ad->price_pledge}} %</div>
                                            @endif
                                        </div>
                                    </div>

                                    <h5>Расположение</h5>
                                    <p class="card-text">{{$search_ad->location}}</p>
                                    <h5>Параметры жилья </h5>
                                    <p class="card-text mb-3">
                                        Количество комнат: {{$search_ad->rooms_count}} <br>
                                        Количесвто сожителей в квартире: {{$search_ad->roommate_count}} <br>
                                        @if($search_ad->floor)
                                            Этаж: {{$search_ad->floor}} {{($search_ad->floor_from) ? 'из '.$search_ad->floor_from : ''}}
                                        @endif

                                        <br><br>
                                        @if($search_ad->square_general)
                                            Площадь общая: {{$search_ad->square_general}} м²
                                            <br>
                                        @endif
                                        @if($search_ad->square_living)
                                            Площадь жилая: {{$search_ad->square_living}} м²
                                            <br>
                                        @endif
                                        @if($search_ad->square_kitchen)
                                            Площадь кухни: {{$search_ad->square_kitchen}} м²
                                            <br>
                                        @endif
                                    </p>
                                    <h5>Условия проживания</h5>
                                    <p class="card-text mb-3">
                                        @if($search_ad->apartment_condition)
                                            Состояние квартиры: {{$search_ad->apartment_condition->title}} <br>
                                        @endif

                                        @if($search_ad->kitchen_studio)
                                            Тип кухни: Кухня студия
                                        @endif
                                    </p>

                                    <h5>Дополнительное информация</h5>
                                    <p class="card-text mb-3">
                                        @if($search_ad->ad_gender_type_id)
                                            В квартире: {{$search_ad->gender_type->title}} <br>
                                        @endif

                                        @if($search_ad->apartment_furniture_status_id)
                                                Квартира меблирована: {{$search_ad->apartment_furniture_status->title}}
                                                <br>
                                            @endif
                                            @if($search_ad->balconies_count)
                                                Количество балконов: {{$search_ad->balconies_count}} <br>
                                            @endif
                                            @if($search_ad->loggias_count)
                                                Количество лоджии: {{$search_ad->loggias_count}}  <br>
                                            @endif
                                        @if($search_ad->bathrooms_count)
                                                Количество санузлов: {{$search_ad->bathrooms_count}} <br>
                                        @endif


                                        @if($search_ad->apartment_for->count())
                                        <h6>Кому подойдет квартира</h6>
                                            @foreach($search_ad->apartment_for as $data)
                                                <button class="btn btn-light mb-1 text-truncate">{{$data->title}}</button>

                                                @endforeach
                                                <br> <br>
                                            @endif

                                        @if($search_ad->apartment_furniture->count())
                                        <h6>Мебель</h6>
                                            @foreach($search_ad->apartment_furniture as $data)
                                                <button class="btn btn-light mb-1 text-truncate">{{$data->title}}</button>

                                                @endforeach
                                                <br> <br>
                                            @endif

                                        @if($search_ad->apartment_facilities->count())
                                        <h6>Удобства</h6>
                                            @foreach($search_ad->apartment_facilities as $data)
                                                <button class="btn btn-light mb-1 text-truncate">{{$data->title}}</button>

                                                @endforeach
                                                <br> <br>
                                            @endif

                                        @if($search_ad->apartment_bathrooms_types->count())
                                        <h6>Санузел</h6>
                                            @foreach($search_ad->apartment_bathrooms_types as $data)
                                                <button class="btn btn-light mb-1 text-truncate">{{$data->title}}</button>

                                                @endforeach
                                                <br> <br>
                                            @endif

                                        @if($search_ad->apartment_bathrooms->count())
                                        <h6>Ванная комната</h6>
                                            @foreach($search_ad->apartment_bathrooms as $data)
                                                <button class="btn btn-light mb-1 text-truncate">{{$data->title}}</button>

                                                @endforeach
                                                <br> <br>
                                            @endif


                                        @if($search_ad->window_directions->count())
                                        <h6>Окна</h6>
                                            @foreach($search_ad->window_directions as $data)
                                                <button class="btn btn-light mb-1 text-truncate">{{$data->title}}</button>

                                                @endforeach
                                                <br> <br>
                                            @endif

                                    <p>


                                    <div class="card mb-3 border-grey">
                                        <div class="card-body">
                                            <div class="card-title d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="text-muted">Автор объявление</div>
                                                    <span>{{$search_ad->contact_name}}</span>
                                                </div>
                                                <div>
                                                    <img src="{{$search_ad->user->profile_photo_url}}" class="rounded object-fit-contain" height="72" width="72" alt="user">
                                                </div>
                                            </div>
                                            <div class="h4"><a href="tel:{{$search_ad->phone_number}}" class="text-decoration-none text-dark">{{$search_ad->phone_number}}</a></div>
                                            <div> <small><a href = "mailto:{{$search_ad->contact_email}}" class="text-decoration-none text-dark">{{$search_ad->contact_email}}</a></small></div>
                                        </div>
                                    </div>
                                </section>
                            </article>

                        </div>
                    </div>
                </div>

                <div class="px-3">
                    <h4>Расположение на карте</h4>
                    <input type="text" name="location" class="form-control" id="location" value="{{$search_ad->location}}" required readonly hidden>
                    <div id="map" class="col w-100 my-3" style="height: 500px"></div>
                </div>


            </section>



    </article>

    <x-slot name="script">
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=80cba268-81a1-44b3-a4fd-b15b982ed47d" type="text/javascript"></script>
        <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script>
            ymaps.ready(init);

            function init() {
                var myPlacemark,
                    myMap = new ymaps.Map('map', {
                        center: [<?=explode(",", $search_ad->coordinates)[0]?>,<?=explode(",", $search_ad->coordinates)[1];?>],
                        zoom: 17
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                myPlacemark = new ymaps.Placemark([<?=explode(",", $search_ad->coordinates)[0]?>,<?=explode(",", $search_ad->coordinates)[1];?>], { content: '{{substr($search_ad->location, 0, 15)}}', balloonContent: '{{substr($search_ad->location, 0, 15)}}' });
                myMap.geoObjects.add(myPlacemark);

            }
        </script>
    </x-slot>
</x-app-layout>
