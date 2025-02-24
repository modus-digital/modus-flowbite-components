@php
    $toasts = session()->get('app::toasts') ?? [];
@endphp

<div
    @class([
        'fixed z-50 space-y-4 w-full max-w-xs',
        'top-0 right-4' => config('modus-ui.toasts.position') === 'top-right',
        'bottom-4 right-4' => config('modus-ui.toasts.position') === 'bottom-right',
        'top-0 left-4' => config('modus-ui.toasts.position') === 'top-left',
        'bottom-4 left-4' => config('modus-ui.toasts.position') === 'bottom-left',
    ])
    x-data="{
        toasts: @js($toasts),
        addToast(toast) {
            toast.id = toast.id || Date.now();
            toast.type = toast.type || 'info';
            this.toasts.push(toast);
        }
    }"
    @toast.window="addToast($event.detail)"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            :id="'toast-' + toast.id"
            class="relative w-full p-4 text-gray-500 bg-white rounded-t-lg rounded-b-md shadow dark:bg-gray-800 dark:text-gray-400"
            role="alert"
            x-data="{
                show: true,
                timeout: null,
                hovered: false,
                progress: 100,
                startCountdown() {
                    const duration = {{ config('modus-ui.toasts.duration') }} / 100;
                    this.timeout = setInterval(() => {
                        if (!this.hovered) {
                            this.progress -= 1;
                            if (this.progress <= 0) {
                                clearInterval(this.timeout);
                                this.show = false;
                                this.toasts = this.toasts.filter(t => t.id !== toast.id);
                            }
                        }
                    }, duration);
                },
                stopCountdown() {
                    clearInterval(this.timeout);
                }
            }"
            x-init="startCountdown()"
            x-show="show"
            x-on:mouseenter="hovered = true; stopCountdown()"
            x-on:mouseleave="hovered = false; startCountdown()"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
        >
            <div class="flex w-full">
                <div
                    :class="{
                        'inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg': true,
                        'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200': toast.type === 'success',
                        'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200': toast.type === 'error',
                        'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200': toast.type === 'warning',
                        'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200': toast.type === 'info'
                    }"
                >
                    <template x-if="toast.type === 'success'">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                    </template>
                </div>
                <div class="ms-3 text-sm font-normal">
                    <template x-if="toast.title">
                        <h2 class="font-semibold" x-text="toast.title"></h2>
                    </template>
                    <template x-if="!toast.title && toast.message">
                        <h2 class="font-semibold" x-text="toast.message"></h2>
                    </template>
                    <template x-if="toast.title && toast.message">
                        <div class="text-sm font-normal" x-text="toast.message"></div>
                    </template>
                </div>
                <button
                    type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    x-on:click="show = false"
                    aria-label="Close"
                >
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <div 
                x-show="@js(config('modus-ui.toasts.progress', true))"
                class="absolute bottom-0 left-0 h-2 rounded-r-lg rounded-b-lg" 
                :class="{
                    'bg-green-300 dark:bg-green-600': toast.type === 'success',
                    'bg-red-300 dark:bg-red-600': toast.type === 'error', 
                    'bg-yellow-300 dark:bg-yellow-600': toast.type === 'warning',
                    'bg-blue-300 dark:bg-blue-600': toast.type === 'info',
                    'bg-gray-300 dark:bg-gray-600': !toast.type
                }" 
                :style="{ width: progress + '%' }"
            ></div>
        </div>
    </template>
</div>

@php
    session()->forget('app::toasts');
@endphp
