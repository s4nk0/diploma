<button  onclick="Livewire.emit('openModal', 'modal.cities')" class="btn d-flex justify-content-center-md justify-content-center flex-wrap-md flex-wrap">
    <i class="bi bi-cursor h5 px-2 m-0" ></i>
    <span>{{ ($city) ? $city->title : '' }}</span>
</button>
