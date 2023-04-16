<div class="row">

    <div class="col-3">
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted"><i class="bi bi-sliders me-2"></i> Фильтр</span>
            <a href="" class="text-primary">Очистить фильтр</a>
        </div>

        <h6>Цена</h6>
        <div class="row">
            <div class="col-sm-6"><input type="number" wire:model="price_from" min="1" class="form-control" placeholder="От"></div>
            <div class="col-sm-6"><input type="number" wire:model="price_to" min="2" class="form-control" placeholder="До"></div>
        </div>

        <h6>Параметры жилья</h6>
        <div class="row">
            <div class="col-sm-6"><input type="number" min="1" class="form-control" placeholder="От"></div>
            <div class="col-sm-6"><input type="number" min="2" class="form-control" placeholder="До"></div>
        </div>
    </div>
    <div class="col-9">
        <h2>Все объявления</h2>
        <small>Найдено {{$result_count}} результатов</small>

        @if($result->count())
            @foreach($result as $data)

                <div class="card mb-3 border-0" style="height: 232px">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="@if($data['class'] == \App\Models\Ad::class){{($data->getFirstMedia('images')) ? $data->getFirstMedia('images')->preview_url  : $data->user->profile_photo_url}} @elseif($data['class'] == \App\Models\AdGet::class) {{$data->user->profile_photo_url}} @endif" class="img-fluid rounded-start" width="230" alt="...">
                        </div>
                        <div class="col-md-8">
                            <a href="{{($data['class'] == \App\Models\Ad::class) ? route('user.search_ad.show',['search_ad'=>$data]) : ''}}{{($data['class'] == \App\Models\AdGet::class) ? route('user.get_ad.show',['get_ad'=>$data]) : ''}}" class="card-body d-flex flex-column justify-content-between h-100 text-decoration-none"  style="color: inherit" >
                                <div>
                                    <h5 class="card-title d-flex justify-content-between">{{$data->rooms_count}} - комнатная квартира
                                        @if($data['class'] == \App\Models\Ad::class)
                                            <small class="text-muted">{{__('ad.search_ad')}}</small>
                                        @elseif($data['class'] == \App\Models\AdGet::class)
                                            <small class="text-muted">{{__('ad.get_ad')}}</small>
                                        @endif
                                    </h5>
                                    <h6>{{$data->location}}</h6>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                                <div class="card-text d-flex justify-content-between">
                                    <small class="text-body-secondary">{{$data->createdAtDiffForHumans}}</small>
                                    <h6>{{$data->price}}  ₸</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$result->links()}}
        @else
            <small class="text-muted">Ничего не найдено</small>
        @endif
    </div>
</div>
