<div class="card border-0">
    <div class="card-body">
    <div class="card-title">Войти</div>
    <div class="form-floating mb-3">
        <input
            x-data="{ mask: '+79999999999' }"
            id="phone_number" class="form-control form-orange" wire:model="phone_number" x-mask="+79999999999" >
        <label for="phone_number" class="text-orange">Введите номер телефона</label>
    </div>



    <x-jet-validation-errors />

    @if ($code_send)
        @if (session()->has('code_send'))
        <div class="alert alert-success">
            {{ session('code_send') }}
        </div>
        @endif
            <div class="form-floating mb-3">
                <input type="number" id="phone_number"  min="1" maxlength="4" class="form-control form-orange" wire:model="verify_code"  >
                <label for="phone_number" class="text-orange">Введите код подверждения</label>
            </div>
    @else
        <button class="btn btn-orange" wire:click.prevent="sendCode()">Отправить код</button>
    @endif

    <a class="btn btn-link" href="{{route('login.email')}}">Войти через email</a>
    </div>
</div>
