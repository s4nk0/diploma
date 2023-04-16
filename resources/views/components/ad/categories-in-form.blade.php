<div>
    <div class="mb-3">
        <label for="category"  class="form-label control-label">Категория</label>
        <div>
        <a href="{{route('user.search_ad.create')}}" class="btn {{ Request::routeIs('user.search_ad.create') ? 'btn-orange' : 'btn-light' }}  ">Ищу Сожителя</a>
        <a href="{{route('user.get_ad.create')}}" class="btn btn-light  {{ Request::routeIs('user.get_ad.create') ? 'btn-orange' : 'btn-light' }}  "">Сниму комнату</a>
        </div>
    </div>

</div>
