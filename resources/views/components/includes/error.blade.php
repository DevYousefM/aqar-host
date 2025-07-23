@if (session('error'))
    <div id="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    <script>
        let alert = document.getElementById("error");
        if (alert) {
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
    </script>
@endif
