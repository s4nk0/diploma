<x-app-layout>
    <form action="{{route('user.get_ad.store')}}" method="post">
        @csrf
        <x-ad.categories-in-form/>

        <div class="row mb-3">
            <x-jet-validation-errors class="mb-4" />
            <label for="rooms_count"  class="col-sm-3 control-label">Количество комнат</label>
            <div class="col-sm-2">
                <input type="number" min="1" class="form-control" id="rooms_count" name="rooms_count" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="price"  class="col-sm-3 control-label">Количесвто сожителей в квартире</label>
            <div class="col-sm-2 d-flex align-items-center">
                <input type="number" min="1" class="form-control me-2" id="price" name="roommate_count" required>
            </div>
        </div>

        <div class="row mb-3">

            <label for="category"  class="col-sm-3 control-label">Цена</label>
            <div class="col-sm-6 d-flex align-items-center">
                <div class="row">
                    <div class="col-md mb-2">
                        <div class="form-floating">
                            <input type="number" min="1" name="price_from" class="form-control" id="price_from" required>
                            <label for="price_from"  class="col-sm-3 control-label">Цена от</label>
                        </div>
                    </div>

                    <div class="col-md mb-2">
                        <div class="form-floating">
                            <input type="number" min="1" class="form-control" name="price" id="price">
                            <label for="price"  class="col-sm-3 control-label">Цена до</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="category"  class="col-sm-3 control-label">Текст объявления</label>
            <div class="col-8">
                <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <h3>Расположение</h3>
            <div class="row mb-3">
                <label for="city_id" class="control-label mb-2">Город</label>
                <div class="col-4">
                    <select name="city_id" size="11" class="form-select" id="city_id">
                        @if($cities->count())
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->title}}</option>
                            @endforeach
                        @else
                            <option disabled>Пусто</option>
                        @endif
                    </select>
                </div>

            </div>

            <div class="row mb-3">
                <h5 id="location_header">Обязательно укажите примерное расположение на карте</h5>
            </div>
            <div class="row">
                <input type="text" name="coordinates" id="coords" hidden>
                <input type="text" name="location" class="form-control" id="location" style="visibility: hidden" required readonly>
                <div id="location_invalid" class="invalid-feedback">
                    <div id="messageHeader"></div>
                    <div id="message"></div>
                    <p id="notice">Адрес не найден</p>
                </div>
                <div id="map" class="col w-100 my-3" style="height: 500px"></div>
            </div>
            <hr>
        </div>

        <h3 class="my-3">Дополнительно</h3>
        <div class="row mb-3">
            <label for="category"  class="col-sm-3">Домашние животные в квартире</label>
            <div class="col">
                <input type="radio" class="btn-check" name="animals" value="1" id="animals_true" autocomplete="off">
                <label class="btn btn-outline-orange" for="animals_true" >Да</label>

                <input type="radio" class="btn-check" name="animals" value="0" id="animals_false" autocomplete="off">
                <label class="btn btn-outline-orange" for="animals_false" >Нет</label>
            </div>
        </div>

        <div class="row mb-3">
            <label for="category"  class="col-sm-3">В квартире</label>
            <div class="col">
                @foreach($ad_gender_types as $type)
                    <input type="radio" class="btn-check" name="ad_gender_type_id" value="{{$type->id}}" id="ad_gender_type_{{$type->id}}" autocomplete="off">
                    <label class="btn btn-outline-orange" for="ad_gender_type_{{$type->id}}" >{{$type->title}}</label>
                @endforeach
            </div>
        </div>




        <hr>

        <h3 class="my-3">Контактная информация</h3>
        <div class="row mb-3">
            <label for="category"  class="col-sm-3 control-label">Имя</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="contact_name" value="{{(Auth::check()) ? Auth::user()->name : '' }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="category"  class="col-sm-3 control-label">Телефон</label>
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <input  x-data="{ mask: '+79999999999' }" x-mask="+79999999999" name="phone_number" class="form-control form-orange ms-2" value="{{(Auth::check()) ? Auth::user()->phone_number : '' }}" required>
                </div>

            </div>
        </div>

        <div class="row mb-3">
            <label for="category"  class="col-sm-3 control-label">Эл. почта</label>
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <input type="email" name="contact_email" class="form-control" value="{{(Auth::check()) ? Auth::user()->email : '' }}" required>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-orange">Создать</button>

    </form>

    <x-slot name="script">
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=80cba268-81a1-44b3-a4fd-b15b982ed47d" type="text/javascript"></script>
        <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
        <script>
            ymaps.ready(init);

            function init() {
                var myPlacemark,
                    myMap = new ymaps.Map('map', {
                        center: [43.23533174349779,76.94582796289055],
                        zoom: 10
                    }, {
                        searchControlProvider: 'yandex#search'
                    });

                // Слушаем клик на карте.
                myMap.events.add('click', function (e) {
                    var coords = e.get('coords');

                    // Если метка уже создана – просто передвигаем ее.
                    if (myPlacemark) {
                        myPlacemark.geometry.setCoordinates(coords);
                    }
                    // Если нет – создаем.
                    else {
                        myPlacemark = createPlacemark(coords);
                        myMap.geoObjects.add(myPlacemark);
                        // Слушаем событие окончания перетаскивания на метке.
                        myPlacemark.events.add('dragend', function () {
                            getAddress(myPlacemark.geometry.getCoordinates());
                        });
                    }
                    getAddress(coords);
                });

                function geocode() {
                    // Забираем запрос из поля ввода.
                    var request = $('#location').val();
                    // Геокодируем введённые данные.
                    ymaps.geocode(request).then(function (res) {
                        var obj = res.geoObjects.get(0),
                            error, hint;

                        if (obj) {
                            // Об оценке точности ответа геокодера можно прочитать тут: https://tech.yandex.ru/maps/doc/geocoder/desc/reference/precision-docpage/
                            switch (obj.properties.get('metaDataProperty.GeocoderMetaData.precision')) {
                                case 'exact':
                                    break;
                                case 'number':
                                case 'near':
                                case 'range':
                                    error = 'Неточный адрес, требуется уточнение';
                                    hint = 'Уточните номер дома';
                                    break;
                                case 'street':
                                    error = 'Неполный адрес, требуется уточнение';
                                    hint = 'Уточните номер дома';
                                    break;
                                case 'other':
                                default:
                                    error = 'Неточный адрес, требуется уточнение';
                                    hint = 'Уточните адрес';
                            }
                        } else {
                            error = 'Адрес не найден';
                            hint = 'Уточните адрес';
                        }

                        // Если геокодер возвращает пустой массив или неточный результат, то показываем ошибку.
                        if (error) {
                            showError(error);
                            showMessage(hint);
                        } else {
                            showResult(obj);
                        }
                    }, function (e) {
                        console.log(e)
                    })

                }
                function showResult(obj) {
                    // Удаляем сообщение об ошибке, если найденный адрес совпадает с поисковым запросом.
                    $('#location').removeClass('is-invalid');
                    $('#location').addClass('is-valid');
                    $('#location_invalid').removeClass('invalid-feedback');
                    $('#location_invalid').addClass('valid-feedback');
                    $('#location_invalid').css('display', 'block');
                    $('#notice').css('display', 'none');

                    var mapContainer = $('#map'),
                        bounds = obj.properties.get('boundedBy'),
                        // Рассчитываем видимую область для текущего положения пользователя.
                        mapState = ymaps.util.bounds.getCenterAndZoom(
                            bounds,
                            [mapContainer.width(), mapContainer.height()]
                        ),
                        // Сохраняем полный адрес для сообщения под картой.
                        address = [obj.getCountry(), obj.getAddressLine()].join(', '),
                        // Сохраняем укороченный адрес для подписи метки.
                        shortAddress = [obj.getThoroughfare(), obj.getPremiseNumber(), obj.getPremise()].join(' ');
                    // Убираем контролы с карты.
                    mapState.controls = [];
                    // Выводим сообщение под картой.
                    showMessage(address);
                }

                function showError(message) {
                    $('#notice').text(message);
                    $('#location').removeClass('is-valid');
                    $('#location').addClass('is-invalid');
                    $('#location_invalid').removeClass('valid-feedback');
                    $('#location_invalid').addClass('invalid-feedback');
                    $('#location_invalid').css('display', 'block');
                    $('#messageHeader').text('');
                    $('#message').text('');
                    $('#notice').css('display', 'block');
                    // Удаляем карту.
                    if (map) {
                        map.destroy();
                        map = null;
                    }
                }

                function createMap(state, caption) {
                    // Если карта еще не была создана, то создадим ее и добавим метку с адресом.
                    if (!map) {
                        map = new ymaps.Map('map', state);
                        placemark = new ymaps.Placemark(
                            map.getCenter(), {
                                iconCaption: caption,
                                balloonContent: caption
                            }, {
                                preset: 'islands#redDotIconWithCaption'
                            });
                        map.geoObjects.add(placemark);
                        // Если карта есть, то выставляем новый центр карты и меняем данные и позицию метки в соответствии с найденным адресом.
                    } else {
                        map.setCenter(state.center, state.zoom);
                        placemark.geometry.setCoordinates(state.center);
                        placemark.properties.set({iconCaption: caption, balloonContent: caption});
                    }
                }

                function showMessage(message) {
                    $('#messageHeader').text('Данные получены:');
                    $('#message').text(message);
                }
                // Создание метки.
                function createPlacemark(coords) {
                    return new ymaps.Placemark(coords, {
                        iconCaption: 'поиск...'
                    }, {
                        preset: 'islands#violetDotIconWithCaption',
                        draggable: true
                    });
                }

                // Определяем адрес по координатам (обратное геокодирование).
                function getAddress(coords) {
                    myPlacemark.properties.set('iconCaption', 'поиск...');
                    ymaps.geocode(coords).then(function (res) {
                        var firstGeoObject = res.geoObjects.get(0);

                        myPlacemark.properties
                            .set({
                                // Формируем строку с данными об объекте.
                                iconCaption: [
                                    // Название населенного пункта или вышестоящее административно-территориальное образование.
                                    firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                                    // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                    firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                ].filter(Boolean).join(', '),
                                // В качестве контента балуна задаем строку с адресом объекта.
                                balloonContent: firstGeoObject.getAddressLine()
                            });
                        document.getElementById("coords").value = coords;
                        document.getElementById("location").value = myPlacemark.properties._data.balloonContent;
                        document.getElementById("location").style = 'visibility: visable';

                        geocode();
                    });
                }
            }

            $( "form" ).submit(function( event ) {
                if ( $('#location').hasClass('is-invalid') || !$('#location').val()) {
                    var elementClick = "#location_header";
                    var destination = $(elementClick).offset().top;
                    jQuery("html:not(:animated),body:not(:animated)").animate({
                        scrollTop: destination
                    }, 800);
                    return false;

                    return false;
                }
                return true;
            });
        </script>
    </x-slot>
</x-app-layout>
