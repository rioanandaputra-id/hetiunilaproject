<!-- resources/views/partials/notifications.blade.php -->
@if (session('success'))
    <div class="bg-green-500 text-white font-bold rounded-lg border shadow-lg p-4 mb-6">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-500 text-white font-bold rounded-lg border shadow-lg p-4 mb-6">
        {{ session('error') }}
    </div>
@endif
