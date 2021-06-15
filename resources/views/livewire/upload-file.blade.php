<div>



    <form wire:submit.prevent="save">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <!-- File Input -->
                    <div class="input-group mb-3">
                        <button wire:loading.remove type="submit" class="btn btn-danger" id="inputGroupFileAddon03">Save File</button>
                        <input wire:model="file" type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                    </div>


                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>

                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>



    </form>


</div>