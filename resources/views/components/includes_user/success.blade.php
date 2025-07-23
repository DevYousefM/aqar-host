@if (session('success'))
    <div id="success" style="padding: 20px;background-color: #198754;color: white"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"><span
            class="block sm:inline" style=" padding-right: 2rem; ">{{ session('success') }}</span></div>
    <script>
        let success = document.getElementById("success");
        if (success) {
            setTimeout(() => {
                success.remove();
            }, 5000);
        }
    </script>
@endif
