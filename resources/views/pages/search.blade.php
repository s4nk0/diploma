<x-app-layout>
    <div class="row">
        <div class="col-3">
            <form action="{{route('search',['search'=>($search) ?? null])}}" method="get">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted"><i class="bi bi-sliders me-2"></i> Фильтр</span>
                <a href="{{route('search')}}" class="text-primary">Очистить фильтр</a>
            </div>

            <h6>Цена</h6>
            <div class="row mb-3">
                <div class="col-sm-6"><input type="number" name="price_from" min="1" class="form-control" placeholder="От" value="{{@$_GET['price_from']}}"></div>
                <div class="col-sm-6"><input type="number" name="price_to" min="2" class="form-control" placeholder="До" value="{{@$_GET['price_to']}}"></div>
            </div>

            <h6>Город</h6>
                <div class="mb-3">
                    <select name="city_id" class="form-select" id=city"">
                        <option disabled selected>Город</option>
                        @if($cities->count())
                        @foreach($cities as $data)
                                <option value="{{$data->id}}" {{(@$_GET['city_id'] == $data->id) ? 'selected' : ''}}>{{$data->title}}</option>
                        @endforeach
                        @else
                            <option disabled>Пусто</option>
                        @endif
                    </select>
                    @error('city_id')
                    <div class="invalid-feedback" style="display: block">
                        Не правильно выбран город
                    </div>
                    @enderror
                </div>

            <h6>Количество комнат</h6>
            <div class="row mb-3">
                <div class="col">
                    <input type="radio" class="btn-check" name="rooms_count" value="1" id="rooms_count_1" autocomplete="off" {{(@$_GET['rooms_count'] == 1) ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="rooms_count_1" >1</label>

                    <input type="radio" class="btn-check" name="rooms_count" value="2" id="rooms_count_2" autocomplete="off" {{(@$_GET['rooms_count'] == 2) ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="rooms_count_2" >2</label>

                    <input type="radio" class="btn-check" name="rooms_count" value="3" id="rooms_count_3" autocomplete="off" {{(@$_GET['rooms_count'] == 3) ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="rooms_count_3" >3</label>

                    <input type="radio" class="btn-check" name="rooms_count" value="4" id="rooms_count_4" autocomplete="off" {{(@$_GET['rooms_count'] == 4) ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="rooms_count_4" >4</label>

                    <input type="radio" class="btn-check" name="rooms_count" value="5" id="rooms_count_5" autocomplete="off" {{(@$_GET['rooms_count'] == 5) ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="rooms_count_5" >5+</label>
                </div>
            </div>

                @if($ad_gender_types->count())
                    <h6>В квартире</h6>
                    <div class="row mb-3">
                        <div class="col">
                            @foreach($ad_gender_types as $type)
                                <input type="radio" class="btn-check" name="ad_gender_type_id" value="{{$type->id}}" id="ad_gender_type_{{$type->id}}"  autocomplete="off" {{(@$_GET['ad_gender_type_id'] == $type->id) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="ad_gender_type_{{$type->id}}" >{{$type->title}}</label>
                            @endforeach
                        </div>
                    </div>
                @endif

            <h6>Категория</h6>
            <div class="row mb-3">
                <div class="col">
                    <input type="radio" class="btn-check" name="category" value="search_ad" id="category_1" autocomplete="off" {{(@$_GET['category'] == 'search_ad') ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="category_1" >{{__('ad.search_ad')}}</label>

                    <input type="radio" class="btn-check" name="category" value="get_ad" id="category_2" autocomplete="off" {{(@$_GET['category'] == 'get_ad') ? 'checked' : ''}}>
                    <label class="btn btn-outline-orange mb-1" for="category_2" >{{__('ad.get_ad')}}</label>
                </div>

            </div>

                <div class="mb-3">
                    <p>
                        <button class="btn btn-link ps-0 ms-0" type="button" data-bs-toggle="collapse" data-bs-target="#additional" aria-expanded="false" aria-controls="additional">
                            Дополнительно
                        </button>
                    </p>
                    <div class="collapse {{(
                                        (isset($_GET['roommate_count']) && $_GET['roommate_count'] !== '')
                                        || (isset($_GET['bathrooms_count']) && $_GET['bathrooms_count'] !== '')
                                        || (isset($_GET['balconies_count']) && $_GET['balconies_count'] !== '')
                                        || (isset($_GET['loggias_count']) && $_GET['loggias_count'] !== '')
                                        || (isset($_GET['floor']) && $_GET['floor'] !== '')
                                        || (isset($_GET['floor_from']) && $_GET['floor_from'] !== '')
                                        || (isset($_GET['square_general']) && $_GET['square_general'] !== '')
                                        || (isset($_GET['square_living']) && $_GET['square_living'] !== '')
                                        || (isset($_GET['square_kitchen']) && $_GET['square_kitchen'] !== '')
                                        || (isset($_GET['kitchen_studio']) && $_GET['kitchen_studio'] !== '')
                                        ) ? 'show' : ''}}"
                         id="additional">
                        <h6>Количество сожителей</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="radio" class="btn-check" name="roommate_count" value="1" id="roommate_count_1" autocomplete="off" {{(@$_GET['roommate_count'] == 1) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="roommate_count_1" >1</label>

                                <input type="radio" class="btn-check" name="roommate_count" value="2" id="roommate_count_2" autocomplete="off" {{(@$_GET['roommate_count'] == 2) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="roommate_count_2" >2</label>

                                <input type="radio" class="btn-check" name="roommate_count" value="3" id="roommate_count_3" autocomplete="off" {{(@$_GET['roommate_count'] == 3) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="roommate_count_3" >3</label>

                                <input type="radio" class="btn-check" name="roommate_count" value="4" id="roommate_count_4" autocomplete="off" {{(@$_GET['roommate_count'] == 4) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="roommate_count_4" >4</label>

                                <input type="radio" class="btn-check" name="roommate_count" value="5" id="roommate_count_5" autocomplete="off" {{(@$_GET['roommate_count'] == 5) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="roommate_count_5" >5+</label>
                            </div>
                        </div>

                        <h6>Количество санузлов</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="radio" class="btn-check" name="bathrooms_count" value="1" id="bathrooms_count_1" autocomplete="off" {{(@$_GET['bathrooms_count'] == 1) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="bathrooms_count_1" >1</label>

                                <input type="radio" class="btn-check" name="bathrooms_count" value="2" id="bathrooms_count_2" autocomplete="off" {{(@$_GET['bathrooms_count'] == 2) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="bathrooms_count_2" >2</label>

                                <input type="radio" class="btn-check" name="bathrooms_count" value="3" id="bathrooms_count_3" autocomplete="off" {{(@$_GET['bathrooms_count'] == 3) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="bathrooms_count_3" >3</label>
                            </div>
                        </div>

                        <h6>Количество балконов</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="radio" class="btn-check" name="balconies_count" value="1" id="balconies_count_1" autocomplete="off" {{(@$_GET['balconies_count'] == 1) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="balconies_count_1" >1</label>

                                <input type="radio" class="btn-check" name="balconies_count" value="2" id="balconies_count_2" autocomplete="off" {{(@$_GET['balconies_count'] == 2) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="balconies_count_2" >2</label>

                                <input type="radio" class="btn-check" name="balconies_count" value="0" id="balconies_count_0" autocomplete="off" {{(isset($_GET['balconies_count']) && $_GET['balconies_count'] == 0) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="balconies_count_0" >Нет</label>
                            </div>
                        </div>

                        <h6>Количество лоджии</h6>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="radio" class="btn-check" name="loggias_count" value="1" id="loggias_count_1" autocomplete="off" {{(@$_GET['loggias_count'] == 1) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="loggias_count_1" >1</label>

                                <input type="radio" class="btn-check" name="loggias_count" value="2" id="loggias_count_2" autocomplete="off" {{(@$_GET['loggias_count'] == 2) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="loggias_count_2" >2</label>

                                <input type="radio" class="btn-check" name="loggias_count" value="0" id="loggias_count_0" autocomplete="off" {{(isset($_GET['loggias_count']) && $_GET['loggias_count'] == 0) ? 'checked' : ''}}>
                                <label class="btn btn-outline-orange mb-1" for="loggias_count_0" >Нет</label>
                            </div>
                        </div>

                        <h6>Этаж</h6>
                        <div class="row align-items-center mb-3">
                            <div class="col-sm-5"><input type="number" name="floor" min="1" class="form-control" placeholder="" value="{{@$_GET['floor']}}"></div>
                            <div class="col-sm-2 p-0 m-0 text-center">из</div>
                            <div class="col-sm-5"><input type="number" name="floor_from" min="2" class="form-control" placeholder="" value="{{@$_GET['floor_from']}}"></div>
                        </div>

                        <h6>Площадь жилья, м²</h6>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <div class="form-floating">
                                    <input type="number" name="square_general" id="square_general" min="1" class="form-control" placeholder=" " value="{{@$_GET['square_general']}}">
                                    <label for="square_general">Общая</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating">
                                    <input type="number" name="square_living" id="square_living" min="1" class="form-control" placeholder=" " value="{{@$_GET['square_living']}}">
                                    <label for="square_living">Жилая</label>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-floating">
                                    <input type="number" name="square_kitchen" id="square_kitchen" min="1" class="form-control" placeholder=" " value="{{@$_GET['square_kitchen']}}">
                                    <label for="square_kitchen">Кухня</label>
                                </div>
                            </div>

                            </div>

                        <h6>Кухня студия</h6>
                        <div class="mb-3">
                            <input type="radio" class="btn-check" name="kitchen_studio" value="1" id="kitchen_studio_true" autocomplete="off" {{(@$_GET['kitchen_studio'] === '1') ? 'checked' : ''}}>
                            <label class="btn btn-outline-orange" for="kitchen_studio_true" >Да</label>

                            <input type="radio" class="btn-check" name="kitchen_studio" value="0" id="kitchen_studio_false" autocomplete="off" {{(@$_GET['kitchen_studio'] === '0') ? 'checked' : ''}}>
                            <label class="btn btn-outline-orange" for="kitchen_studio_false" >Нет</label>
                        </div>



                        </div>

                    </div>



            <div class="row mb-3">
                <div class="col">
                    <button class="btn btn-orange">Фильтровать</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-9">
            <h2>Все объявления</h2>
            <small class="mb-3">Найдено {{$result_count}} результатов</small>

            @if($result->count())
                @foreach($result as $data)
                    @php($link = (get_class($data) == \App\Models\Ad::class) ? route('user.search_ad.show',['search_ad'=>$data]) : route('user.get_ad.show',['get_ad'=>$data]))
                    <div class="card my-3 border-0" style="height: 232px">
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

                                        <livewire:component.search-ad-like :ad="$data" />
                                    </h5>
                                        <a href="{{$link}}" class="text-decoration-none" style="color:inherit">
                                            <h6>{{$data->location}} -  @if(get_class($data) == \App\Models\Ad::class)
                                                    <span class="text-muted">{{__('ad.search_ad')}}</span>
                                                @elseif(get_class($data) == \App\Models\AdGet::class)
                                                    <span class="text-muted">{{__('ad.get_ad')}}</span>
                                                @endif</h6>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        </a>
                                    </div>
                                    <div class="card-text d-flex justify-content-between">
                                        <div class="text-body-secondary">
                                            <span class="me-3">{{$data->createdAtDiffForHumans}}</span>
                                            <span class="me-3 text-muted"><i class="bi bi-eye"></i> {{$data->views}}</span>
                                            <span class="me-3 text-muted"><i class="bi bi-heart"></i> {{$data->liked_users->count()}}</span>

                                        </div>
                                        <h6>{{$data->price}}  ₸</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$result->appends(request()->query())->links()}}
            @else
                <small class="text-muted">Ничего не найдено</small>
            @endif
        </div>
    </div>
</x-app-layout>
