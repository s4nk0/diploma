<i class="bi {{(Auth::check() && $ad->liked_users->find(Auth::user()->id)) ? 'bi-heart-fill' : 'bi-heart'}} text-danger h4 " style="cursor: pointer; {{$style ?? ''}}" wire:click="like"></i>

