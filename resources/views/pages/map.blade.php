<x-app-layout>
    <div id="map" class="col w-100 my-3" style="height: 500px"></div>

    <x-slot name="script">
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=80cba268-81a1-44b3-a4fd-b15b982ed47d" type="text/javascript"></script>
        <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script>
            ymaps.ready(function () {
                var myMap = new ymaps.Map('map', {
                        center: [43.23533174349779,76.94582796289055],
                        zoom: 9,
                        behaviors: ['default', 'scrollZoom']
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    /**
                     * Создадим кластеризатор, вызвав функцию-конструктор.
                     * Список всех опций доступен в документации.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#constructor-summary
                     */
                    clusterer = new ymaps.Clusterer({
                        /**
                         * Через кластеризатор можно указать только стили кластеров,
                         * стили для меток нужно назначать каждой метке отдельно.
                         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
                         */
                        preset: 'islands#invertedVioletClusterIcons',
                        /**
                         * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
                         */
                        groupByCoordinates: false,
                        /**
                         * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
                         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
                         */
                        clusterDisableClickZoom: true,
                        clusterHideIconOnBalloonOpen: false,
                        geoObjectHideIconOnBalloonOpen: false
                    }),
                    /**
                     * Функция возвращает объект, содержащий данные метки.
                     * Поле данных clusterCaption будет отображено в списке геообъектов в балуне кластера.
                     * Поле balloonContentBody - источник данных для контента балуна.
                     * Оба поля поддерживают HTML-разметку.
                     * Список полей данных, которые используют стандартные макеты содержимого иконки метки
                     * и балуна геообъектов, можно посмотреть в документации.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
                     */
                    getPointData = function (index) {
                        return {
                            balloonContentHeader: '<font size=3><b><a target="_blank" href="https://yandex.ru">Здесь может быть ваша ссылка</a></b></font>',
                            balloonContentBody: '<p>Ваше имя: <input name="login"></p><p>Телефон в формате 2xxx-xxx:  <input></p><p><input type="submit" value="Отправить"></p>',
                            balloonContentFooter: '<font size=1>Информация предоставлена: </font> балуном <strong>метки ' + index + '</strong>',
                            clusterCaption: 'метка <strong>' + index + '</strong>'
                        };
                    },
                    /**
                     * Функция возвращает объект, содержащий опции метки.
                     * Все опции, которые поддерживают геообъекты, можно посмотреть в документации.
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
                     */
                    getPointOptions = function () {
                        return {
                            preset: 'islands#violetIcon'
                        };
                    },
                    points = [
                            @foreach($dates as $data)
                            @php($link = (get_class($data) == \App\Models\Ad::class) ? route('user.search_ad.show',['search_ad'=>$data]) : route('user.get_ad.show',['get_ad'=>$data]))

                        {'point' : [{{$data->coordinates}}],
                            'data':  {
                                balloonContentBody:
                                    `
                                @php($link = (get_class($data) == \App\Models\Ad::class) ? route('user.search_ad.show',['search_ad'=>$data]) : route('user.get_ad.show',['get_ad'=>$data]))
                                    <div class="card my-3 border-0" style="">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <a href="{{$link}}">
                            <img src="@if(get_class($data) == \App\Models\Ad::class){{($data->getFirstMedia('images')) ? $data->getFirstMedia('images')->preview_url  : $data->user->profile_photo_url}} @elseif(get_class($data) == \App\Models\AdGet::class) {{$data->user->profile_photo_url}} @endif" class="img-fluid rounded-start" width="230" alt="...">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column justify-content-between h-100 text-decoration-none"  style="color: inherit" >
                            <div>
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    <a href="{{$link}}" class="text-decoration-none" style="color:inherit">{{$data->rooms_count}} - комнатная квартира</a>
                                </h5>
                                <a href="{{$link}}" class="text-decoration-none" style="color:inherit">
                                    <h6>{{strlen($data->location) > 100 ? substr($data->location,0,100)."..." : $data->location}}  </h6> <bt>
                                    @if(get_class($data) == \App\Models\Ad::class)
                                    <p class="text-muted mb-3">{{__('ad.search_ad')}}</span>
                                        @elseif(get_class($data) == \App\Models\AdGet::class)
                                    <p class="text-muted mb-3">{{__('ad.get_ad')}}</span>
                                        @endif
                                    </a>
                                </div>
                                <div class="card-text d-flex justify-content-between">
                                    <div class="text-body-secondary">
                                        <span class="me-3 text-muted"><i class="bi bi-eye"></i> {{$data->views}}</span>
                                    <span class="me-3 text-muted"><i class="bi bi-heart"></i> {{$data->liked_users->count()}}</span>

                                </div>
                                <h6>{{$data->price}}  ₸</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
                                {{--                                  @if(get_class($data) == \App\Models\Ad::class)--}}
                                {{--                                      '<span class="text-muted">{{__('ad.search_ad')}}</span> <br><br><h6> Цена: {{$data->price}}  ₸</h6>'--}}
                                {{--                                  @elseif(get_class($data) == \App\Models\AdGet::class)--}}
                                {{--                                  '<span class="text-muted">{{__('ad.get_ad')}}</span> <br> <br> <h6>Цена: {{$data->price}}  ₸</h6>'--}}
                                {{--                              @endif+--}}
                                {{--                              <div class="text-body-secondary">--}}
                                {{--                                '  <span class="me-3">{{$data->createdAtDiffForHumans}}</span>--}}
                                {{--                                  '<span class="me-3 text-muted"><i class="bi bi-eye"></i> {{$data->views}}</span>--}}
                                {{--                                  '<span class="me-3 text-muted"><i class="bi bi-heart"></i> {{$data->liked_users->count()}}</span>--}}

                                {{--                              '</div>'--}}
                                ,
                                balloonContentFooter: '<font size=1>Информация предоставлена: </font> балуном <strong>метки {{$data->id}} </strong>',
                                clusterCaption: 'метка <strong>{{$data->id}}</strong>'
                            }
                        },
                        @endforeach


                    ],
                    geoObjects = [];

                /**
                 * Данные передаются вторым параметром в конструктор метки, опции - третьим.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
                 */
                for(var i = 0, len = points.length; i < len; i++) {
                    geoObjects[i] = new ymaps.Placemark(points[i]['point'], points[i]['data'], getPointOptions());
                }

                /**
                 * Можно менять опции кластеризатора после создания.
                 */
                clusterer.options.set({
                    gridSize: 80,
                    clusterDisableClickZoom: true
                });

                /**
                 * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
                 */
                clusterer.add(geoObjects);
                myMap.geoObjects.add(clusterer);

                /**
                 * Спозиционируем карту так, чтобы на ней были видны все объекты.
                 */

                myMap.setBounds(clusterer.getBounds(), {
                    checkZoomRange: true
                });
            });
        </script>
    </x-slot>
</x-app-layout>
