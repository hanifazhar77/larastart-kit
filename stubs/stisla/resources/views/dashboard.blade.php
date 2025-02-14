<x-app-layout title="Dashboard">
    @push('style')
        <!-- CSS Libraries -->
    @endpush

    <x-slot name="content">
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>

                <div class="section-body">
                </div>
            </section>
        </div>
    </x-slot>

    @push('scripts')
        <script>
            @if (session('login_success'))
                Swal.fire({
                    title: 'Success',
                    text: 'You have successfully logged in',
                    icon: 'success',
                    timer: 1500
                });
            @endif
        </script>
    @endpush
</x-app-layout>
