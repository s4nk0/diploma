<div>
    <h5 class="text-center mb-5">Ваш город Алматы?</h5>
    <div class="d-flex justify-content-center align-items-center">
        <button class="btn btn-lg btn-orange me-4" wire:click="yes">Да</button>
        <button class="btn btn-lg btn-outline-danger" onclick="Livewire.emit('openModal', 'modal.cities')">Нет</button>
    </div>
</div>
