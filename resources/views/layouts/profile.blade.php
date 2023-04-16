<x-app-layout>
    <div class="row mb-3">
        <div class="col-md-4 col-lg-3 mb-4">
            <x-user.profile.links />
        </div>

        <div class="col-md-8 col-lg-9 mb-3">
            {{$slot}}
        </div>
    </div>
</x-app-layout>
