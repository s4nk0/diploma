<x-admin.user.profile-layout :user="$user">
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
        <a href="#" class="list-group-item list-group-item-action">Нет обявлении</a>
    @endif
        {{$adGet->links()}}
</div>
</x-admin.user.profile-layout>
