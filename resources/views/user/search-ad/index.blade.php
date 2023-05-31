<x-user.profile.layout>
    @if(session()->has('success'))
        <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
            <i class="bi bi-check me-2" style="font-size: 20px;"></i>
            <div>
                {{ session()->get('success') }}
            </div>
        </div>
    @endif
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
                                <div class="card-title d-flex justify-content-between" >
                                <div title="{{$data->location}}" style="max-height: 85px" class="overflow-hidden text-truncate ">
                                    {{$data->location}}
                                </div>
                                <div class="btn
                                    {{ ($data->status_moderation_id == \App\Enums\StatusEnum::STATUS_MODERATION_ACCEPTED_ID->value) ? 'btn-success' :
                                       (($data->status_moderation_id == \App\Enums\StatusEnum::STATUS_MODERATION_PROCESSING_ID->value) ? 'btn-warning' :
                                       (($data->status_moderation_id == \App\Enums\StatusEnum::STATUS_MODERATION_PROCESSING_ID->value) ? 'btn-danger' : 'btn-primary')) }}
                                        ">
                                        {{$data->status_moderation->title}}
                                    </div>
                                </div>
                                <p>Цена: <strong>{{$data->price}} ₸</strong></p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <a href="{{route('user.search_ad.create')}}" class="list-group-item list-group-item-action">У вас нет обявлении нажмите чтобы добавить</a>
        @endif
        {{$ad->links()}}
    </div>
</x-user.profile.layout>
