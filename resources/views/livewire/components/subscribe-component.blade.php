<div>
    <h3>subscribe</h3>
<form wire:submit.prevent="subscribe">
    <input type="email" placeholder="Subscribe" wire:model="email">
    @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
    <button type="submit">
        <b class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading></b>        
        Subscribe
    </button>   
</form>
</div>
