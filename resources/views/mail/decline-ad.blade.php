<div>
    Ваше обьявшение не было принято <a href="https://roommate.kz/">roommate.kz</a> <br>
    @isset($comment)
        <strong>Коментарий</strong> <br>
        {{$comment}}
    @endisset
    <br>
    @isset($ad)
        <strong>Ссылка на обьявления:</strong> <br>

    @if(get_class($ad) == \App\Models\Ad::class)
            <a href="{{route('user.search_ad.edit',['search_ad'=>$ad])}}">{{$ad->location}}</a> <br>
        @elseif(get_class($ad) == \App\Models\AdGet::class)
            <a href="{{route('user.get_ad.edit',['get_ad'=>$ad])}}">{{$ad->location}}</a> <br>
        @endif

    @endisset

</div>
