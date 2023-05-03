<x-admin.user.profile-layout :user="$user">
    <div class="list-group">
        @if($ad->count())
            @foreach($ad as $data)
                <a href="{{route('user.search_ad.edit',['search_ad'=>$data])}}" class="list-group-item list-group-item-action card mb-3 p-0" >
                    <div class="row">
                        <div class="col-3 col-sm-2" >
                            <img src="{{($data->getFirstMedia('images')) ? $data->getFirstMedia('images')->preview_url  : $data->user->profile_photo_url}}" class="img-fluid rounded-start cover w-100 h-100"  width="87" height="87"  alt="image">
                        </div>
                        <div class="col-9 col-sm-10 " >
                            <div class="card-body " >
                                <div class="card-title overflow-hidden text-truncate " title="{{$data->location}}" style="max-height: 85px">{{$data->location}}</div>
                                <p>Цена: <strong>{{$data->price}} ₸</strong></p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <a href="#" class="list-group-item list-group-item-action">Нет обявлении</a>
        @endif
        {{$ad->links()}}
    </div>
</x-admin.user.profile-layout>
