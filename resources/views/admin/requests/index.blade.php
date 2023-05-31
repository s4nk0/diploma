<x-admin-layout>
    <x-crud-table header="Requests">
        <thead>
        <tr class="fw-bolder text-muted">
            <th class="w-25px">
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
                </div>
            </th>
            <th class="min-w-150px">User</th>
            <th class="min-w-100px">Ad</th>
        </tr>
        </thead>
        <tbody>
        @if($dates->count())
            @foreach($dates as $data)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input widget-9-check" type="checkbox" value="1">
                        </div>
                    </td>
                    <td>

                        <div class="d-flex align-items-center">
                            <div>
                                {{ $data->user->name }}
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                @if(get_class($data) == \App\Models\Ad::class)
                                    <a href="{{route('admin.request.search_ad.show',['search_ad'=>$data])}}">{{ $data->location }}</a>

                                    @elseif(get_class($data) == \App\Models\AdGet::class)
                                    <a href="{{route('admin.request.get_ad.show',['get_ad'=>$data])}}">{{ $data->location }}</a>
                                @endif

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>
                </td>
                <td>
                    Empty
                </td>
                <td>
                </td>
            </tr>
        @endif
        </tbody>

        <x-slot name="pagination">
            {{ $dates->links() }}
        </x-slot>

    </x-crud-table>

</x-admin-layout>
