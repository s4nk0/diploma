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
        @if($adGet->count())
            @foreach($adGet as $data)
                <a href="{{route('user.get_ad.edit',['get_ad'=>$data])}}" class="list-group-item list-group-item-action card mb-3 p-0" >
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
                        </div>                        <p title="Цена: {{$data->price_from}} ₸ - {{$data->price}} ₸">Цена: <strong>{{$data->price_from}} ₸</strong> - <strong>{{$data->price}} ₸</strong></p>
                    </div>
                </a>
            @endforeach
        @else
            <a href="{{route('user.get_ad.create')}}" class="list-group-item list-group-item-action">У вас нет обявлении нажмите чтобы добавить</a>
        @endif
    </div>
        {{$adGet->links()}}

</x-user.profile.layout>
