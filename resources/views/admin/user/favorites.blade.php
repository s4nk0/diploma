<x-admin.user.profile-layout :user="$user">
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
                                </h5>
                                <a href="{{$link}}" class="text-decoration-none" style="color:inherit">
                                    <h6>{{$data->location}} -  @if(get_class($data) == \App\Models\Ad::class)
                                            <span class="text-muted">{{__('ad.search_ad')}}</span>
                                        @elseif(get_class($data) == \App\Models\AdGet::class)
                                            <span class="text-muted">{{__('ad.get_ad')}}</span>
                                        @endif</h6>
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
        {{$result->links()}}
    @else
        <small class="text-muted">Ничего не найдено</small>
    @endif
</x-admin.user.profile-layout>
