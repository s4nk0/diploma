<x-app-layout>
    <div class="row bg" style="height: 80vh">
        <div class="col-md-6 justify-content-center d-flex align-content-center flex-wrap bg-orange">
            <div class="text-center text-white">
                <h3>Roommate</h3>
                <p>Roommate for teammate</p>
            </div>

        </div>

        <div class="col-md-6 justify-content-center d-flex align-content-center flex-wrap">
                {{$slot}}
        </div>
    </div>
</x-app-layout>
