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
        <!-- JS Libraies -->

        <!-- Page Specific JS File -->
    @endpush
</x-app-layout>
