@if($ad->count())
<section class="my-3">
    <h3 class="mt-5 mb-3">Ищут сожителей</h3>
    <div class="row">
        @foreach($ad as $data)
        <div class="col-xs-1 col-sm-6 col-md-4 col-lg-3  mb-3">
            <div  class="card mb-4 text-decoration-none h-100" style="color: inherit">
                <livewire:component.search-ad-like :ad="$data" :wire:key="$data->id" style="position:absolute; right:0; padding: 10px 10px" />
                <a href="{{route('user.search_ad.show',['search_ad'=>$data])}}"><img src="{{($data->getFirstMedia('images')) ? $data->getFirstMedia('images')->preview_url  : $data->user->profile_photo_url}}" class="card-img-top" style="max-height: 200px" alt="..." /></a>
                <div class="card-body">
                    <a href="{{route('user.search_ad.show',['search_ad'=>$data])}}" style="color: inherit;text-decoration: none">
                    <div class="card-title d-flex justify-content-between">
                        <strong>{{$data->price}}₸</strong>
                        <p class="text-muted m-0">{{$data->createdAtDiffForHumans}}</p>

                    </div>
                    <p class="card-text text-truncate" title="{{$data->location}}" style="max-height: 48px">
                        {{$data->location}}
                    </p>

                    </a>

            </div>

        </div>
        </div>
        @endforeach
    </div>
    @if(!$hide)
        <button class="btn btn-light text-dark" wire:click.prevent="showMore()">Показать больше</button>
    @endif
</section>
@endif
