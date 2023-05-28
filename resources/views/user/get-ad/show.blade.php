<x-app-layout>
    <article>



        <section class="card mb-3 border-grey">
            <div class="card-header bg-white border-bottom-0">
                <h3 class="d-flex justify-content-between">
                    {{$get_ad->location}}
                    @can('update',$get_ad)
                        <div><a href="{{route('user.get_ad.edit',['get_ad'=>$get_ad])}}" title="Редактировать" class="btn btn-primary"><i class="bi bi-pencil"></i></a></div>
                    @endif
                </h3>
            </div>
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="card-body">
                        <article>
                            <section>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5 class="card-title">Ищут комнату</h5>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        Цена:
                                        <b>{{$get_ad->price_from}} ₸</b> -
                                        <b>{{$get_ad->price}} ₸</b>
                                    </div>
                                </div>

                                <h5>Расположение</h5>
                                <p class="card-text">{{$get_ad->location}}</p>
                                <h5>Желаемые параметры жилья </h5>
                                <p class="card-text mb-3">
                                    @if($get_ad->rooms_count)
                                        Количество комнат: {{$get_ad->rooms_count}} <br>
                                    @endif
                                    @if($get_ad->roommate_count)
                                            Количесвто сожителей в квартире
                                            : {{$get_ad->roommate_count}} <br>
                                    @endif
                                    @if($get_ad->animals !== null)
                                            Домашние животные в квартире:
                                        @if($get_ad->animals  === 0)
                                                Нет
                                            @elseif($get_ad->animals  === 1)
                                                Да
                                            @endif
                                            <br>
                                        @endif

                                    @if($get_ad->ad_gender_type_id)
                                            В квартире:
                                        {{$get_ad->gender_type->title}}

                                        @endif
                                </p>
                                <div class="card mb-3 border-grey">
                                    <div class="card-body">
                                        <div class="card-title d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="text-muted">Автор объявление</div>
                                                <span>{{$get_ad->contact_name}}</span>
                                            </div>
                                            <div>
                                                <img src="{{$get_ad->user->profile_photo_url}}" class="rounded object-fit-cover" height="72" width="72" alt="user">
                                            </div>
                                        </div>
                                        <div class="h4"><a href="tel:{{$get_ad->phone_number}}" class="text-decoration-none text-dark">{{$get_ad->phone_number}}</a></div>
                                        <div> <small><a href = "mailto:{{$get_ad->contact_email}}" class="text-decoration-none text-dark">{{$get_ad->contact_email}}</a></small></div>
                                    </div>
                                </div>
                            </section>
                        </article>

                    </div>
                </div>
                <div class="col-md-6">
                    @if($get_ad->description)
                        <article class="p-3">
                            <section>
                                <h4>Описание</h4>
                                <p>
                                    {{$get_ad->description}}
                                </p>
                            </section>
                        </article>

                    @endif
                </div>

            </div>
        </section>

        <div class="px-3">
            <h4>Расположение на карте</h4>
            <input type="text" name="location" class="form-control" id="location" value="{{$get_ad->location}}" required readonly hidden>
            <div id="map" class="col w-100 my-3" style="height: 500px"></div>
        </div>

    </article>

    <x-slot name="script">
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=80cba268-81a1-44b3-a4fd-b15b982ed47d" type="text/javascript"></script>
        <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script>
            ymaps.ready(init);

            function init() {
                var myPlacemark,
                    myMap = new ymaps.Map('map', {
                        center: [<?=explode(",", $get_ad->coordinates)[0]?>,<?=explode(",", $get_ad->coordinates)[1];?>],
                        zoom: 17
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                myPlacemark = new ymaps.Placemark([<?=explode(",", $get_ad->coordinates)[0]?>,<?=explode(",", $get_ad->coordinates)[1];?>], { content: '{{substr($get_ad->location, 0, 15)}}', balloonContent: '{{substr($get_ad->location, 0, 15)}}' });
                myMap.geoObjects.add(myPlacemark);

            }
        </script>
    </x-slot>
</x-app-layout>
