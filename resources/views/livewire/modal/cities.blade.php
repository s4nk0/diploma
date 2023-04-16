<div>
    <h5>Выберите ваш город из списка</h5>
    <ul class="list-group list-group-flush">
        @foreach($cities as $city)
            <li wire:click="select_city('{{$city->id}}')" class="list-group-item list-group-item-action">{{$city->title}}</li>
        @endforeach
    </ul>
</div>
