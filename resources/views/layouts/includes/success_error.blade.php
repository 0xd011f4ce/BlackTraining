@if (session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p class="error">{{ session('error') }}</p>
@endif
