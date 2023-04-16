<x-app-layout>
    <section class="my-3">
        <a href="{{route('user.search_ad.create')}}" class="btn btn-outline-dark-orange me-2 mb-3">Ищу сожителя</a>
        <a href="{{route('user.get_ad.create')}}" class="btn btn-outline-dark-orange mb-3">Сниму квартиру</a>
    </section>

    <livewire:component.search-ad-view />

    <livewire:component.get-ad-view />

</x-app-layout>
