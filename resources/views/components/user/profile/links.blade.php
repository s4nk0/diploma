<div class="list-group">
    <a class="list-group-item list-group-item-action disabled border-bottom-0">
        Мои Обявление
    </a>
    <a href="{{route('user.search_ad.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('user.search_ad.index') ? 'active' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            <span  class="ms-3" style=>{{__('ad.search_ad')}}</span>
            @if(Auth::user()->ad->count())
            <span class="badge bg-primary rounded-pill">{{Auth::user()->ad()->withForModeration()->count()}}</span>
            @endif
        </div>
    </a>
    <a href="{{route('user.get_ad.index')}}" class="list-group-item list-group-item-action {{ Request::routeIs('user.get_ad.index') ? 'active' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            <span class="ms-3">{{__('ad.get_ad')}}</span>
            @if(Auth::user()->adGet->count())
            <span class="badge bg-primary rounded-pill">{{Auth::user()->adGet()->withForModeration()->count()}}</span>
            @endif
        </div>
    </a>
    <a href="{{route('user.liked')}}" class="list-group-item list-group-item-action {{ Request::routeIs('user.liked') ? 'active' : '' }}">
        <div class="d-flex justify-content-between align-items-center">
            {{__('ad.favorites')}}
            @if(Auth::user()->liked_ad->count() + Auth::user()->liked_ad_gets->count())
            <span class="badge bg-primary rounded-pill">{{Auth::user()->liked_ad->count() + Auth::user()->liked_ad_gets->count()}}</span>
            @endif
        </div>
    </a>
    <a href="{{route('profile.show')}}" class="list-group-item list-group-item-action {{ Request::routeIs('profile.show') ? 'active' : '' }}">
        {{__('Профиль')}}
    </a>
    <a class="list-group-item list-group-item-action text-danger" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
        {{ __('Выйти') }}
    </a>
</div>
