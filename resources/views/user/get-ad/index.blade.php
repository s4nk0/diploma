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
                        <div class="card-title overflow-hidden text-truncate " title="{{$data->location}}" style="max-height: 85px">{{$data->location}}</div>
                        <p title="Цена: {{$data->price_from}} ₸ - {{$data->price}} ₸">Цена: <strong>{{$data->price_from}} ₸</strong> - <strong>{{$data->price}} ₸</strong></p>
                    </div>
                </a>
            @endforeach
        @else
            <a href="{{route('user.get_ad.create')}}" class="list-group-item list-group-item-action">У вас нет обявлении нажмите чтобы добавить</a>
        @endif
    </div>
</x-user.profile.layout>
