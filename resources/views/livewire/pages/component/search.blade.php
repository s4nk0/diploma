<form class="search-box" action="search" method="post" wire:submit.prevent="search">

    <input type="search" wire:model="search" class="form-search form-control " placeholder="Поиск...">
    <button class="btn btn-link search-icon p-0"><i class="bi bi-search "></i></button>


    @if($search !== null && $search !== '')
    <div style="position: absolute; z-index: 10000;  width: 100%;" class="rounded-bottom border shadow-sm">
        <div class="list-group list-group-flush">
            @if($result && $result->count())
                @foreach($result as $data)
                    <a href="{{(get_class($data) == \App\Models\Ad::class) ? route('user.search_ad.show',['search_ad'=>$data]) : ''}}{{(get_class($data) == \App\Models\AdGet::class) ? route('user.get_ad.show',['get_ad'=>$data]) : ''}}" class="list-group-item">
                        <div class="row">
                            <div class="col-2" style="display: grid;place-items: center"><img src="@if(get_class($data) == \App\Models\Ad::class){{($data->getFirstMedia('images')) ? $data->getFirstMedia('images')->preview_url  : $data->user->profile_photo_url}} @elseif(get_class($data) == \App\Models\AdGet::class) {{$data->user->profile_photo_url}} @endif" class="card-img-top w-100 h-100 object-fit-cover"  alt="..."></div>
                            <div class="col-10">
                                @if(get_class($data) == \App\Models\Ad::class)
                                    <small class="text-muted">{{__('ad.search_ad')}}</small>
                                @elseif(get_class($data) == \App\Models\AdGet::class)
                                    <small class="text-muted">{{__('ad.get_ad')}}</small>
                                @endif <br>
                                {{$data->location}}
                            </div>
                        </div>

                    </a>
                @endforeach
            @else
                <a class="list-group-item disabled">Ничего не найдено</a>
            @endif
        </div>

    </div>
    @endif
</form>
