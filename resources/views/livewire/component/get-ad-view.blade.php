@if($ad_get->count())
    <section class="my-3">
        <h3 class="mt-5 mb-3">Ищут комнату</h3>
        <div class="row">
            @foreach($ad_get as $data)
                <div class="col-xs-1 col-sm-6 col-md-4 col-lg-3  ">
                    <div class="card mb-4">
                        <div class="text-decoration-none" style="color: inherit">
                            <livewire:component.search-ad-like :ad="$data" :wire:key="$data->id" style="position:absolute; right:0; padding: 10px 10px" />
                            <a href="{{route('user.get_ad.show',['get_ad'=>$data])}}"><img src="{{$data->user->profile_photo_url}}" class="card-img-top" style="max-height: 200px" alt="..."></a>
                        <div class="card-body">
                            <a href="{{route('user.get_ad.show',['get_ad'=>$data])}}" style="color: inherit;text-decoration: none">
                            <div class="card-title d-flex justify-content-between">
                                <p class="text-muted m-0">{{$data->user->name}}</p>
                                <p class="text-muted m-0">{{$data->createdAtDiffForHumans}}</p>

                            </div>
                            <p class="card-text">
                                <strong>{{$data->price_from}} - {{$data->price}}₸</strong>
                            </p>
                            </a>
                        </div>

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
