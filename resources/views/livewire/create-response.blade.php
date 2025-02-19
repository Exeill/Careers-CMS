@props(['post', 'response'])

{{-- @livewire('notifications') --}}

<div class="text-slate-800 dark:text-white">
    {{-- <button x-data x-on:click="trigger">
            X
        </button> --}}
    @csrf



    <form wire:submit="create" wire:confirm="Are you sure you want to submit this application?"
        enctype="multipart/form-data">

        {{-- {{ $this->form }} --}}
        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false; progress = 0;"
            x-on:livewire-upload-progress="progress = $event.detail.progress">


            <div>

                <div class="mb-5">

                    <span class="text-base md:text-2xl text-bold font-semibold text-gray-600 dark:text-white">Job
                        Application</span>
                    <input type="text" wire:model="post_title" @readonly(true) name="post_title" hidden>
                    <div>
                        @error('post_title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <table class="w-full">

                    <tbody>
                        <tr>
                            <td style="width:25%"><label class="text-sm md:text-base">Date</label></td>
                            <td><input type="text" wire:model="date_response" @readonly(true) name="date_response"
                                    class="!border-none !w-full !mb-4 text-sm md:text-base dark:text-slate-800">
                                <div>
                                    @error('date_response')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Full Name</label></td>

                            <td>

                                <div>
                                    @error('full_name')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="full_name" name="full_name"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800"
                                    autofocus>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Contact</label></td>
                            <td>
                                <div>
                                    @error('contact')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="contact" name="contact"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Email</label></td>
                            <td>
                                <div>
                                    @error('email_address')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="email_address" name="email_address"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="text-sm md:text-base">Current Address</label></td>
                            <td>
                                <div>
                                    @error('current_address')
                                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="text" wire:model.change="current_address" name="current_address"
                                    class="!w-full !mb-4 !rounded-md border-blue-100 text-sm md:text-base  dark:text-slate-800">
                            </td>
                        </tr>
                    </tbody>
                </table>




                {{-- <div class="mt-5 flex gap-5">

                    <span class="text-sm md:text-base">*Attachment</span>

                    <input type="file" wire:model.change="attachment" name="attachment" accept=".pdf, .doc, .docx "
                        class="!w-full !mb-4 border-blue-100 text-sm md:text-base  dark:text-slate-800"
                        instantUpload="true" id="">



                </div>
                <div>
                    @error('attachment')
                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <label class="text-sm font-italic">*Upload your Resume/CV in PDF or Word File Only</label>
                <div x-show="uploading">
                    <div class="w-full h-4 bg-slate-100 rounded-lg shadow-inner mt-3 ">
                        <div class="bg-green-500 h-4 rounded-lg " :style="{ width: `${progress}%` }"></div>
                    </div>
                </div> --}}


                <div class="flex gap-2 mt-5">
                <span class="text-sm md:text-base">*Attachment</span>
                <div x-data="{ isUploading: false, progress: 0 }" 
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    class="w-full"
                    >
                    
                    <!-- File Input -->
                    <input type="file" wire:model="attachment">

                    <!-- Progress Bar -->
                    <div x-show="isUploading" >
                        <progress max="100" x-bind:value="progress" class="w-full"></progress>
                    </div>
                </div>
            </div>

                <div>
                    @error('attachment')
                        <span class="error text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                {{-- <livewire:dropzone
        wire:model="attachment"
        :rules="['file','mimes:pdf,doc','max:10420']"
        :multiple="false" /> --}}



                <div class="float-right">
                    <button wire:loading.class="opacity-50" type="submit"
                        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                        <span wire:loading.remove>Submit</span>
                        <span wire:loading>Loading</span>
                    </button>
                </div>

            </div>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success text-green-700 font-bold py-2">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
    </form>


    <x-filament-actions::modals />



</div>
