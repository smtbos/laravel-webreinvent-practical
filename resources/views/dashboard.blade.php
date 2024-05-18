<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <script>
        function init() {
            return {
                init() {
                    this.start();
                },
                count: 5,
                start() {
                    const interval = setInterval(() => {
                        this.count--;
                        if (this.count === 0) {
                            clearInterval(interval);
                            window.location.href = "{{ route('todos.index') }}";
                        }
                    }, 1000);
                },
            }
        }
    </script>
    <div class="py-12" x-data="init()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}<br><br>
                    <p>Redirecting to todos in <span x-text="count"></span> seconds...</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
