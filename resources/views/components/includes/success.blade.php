@if (session('success'))
    <div class="alert alert-success" id="success">{{ session('success') }}</div>
    <script>
        let alert = document.getElementById("success");
        if (alert) {
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }
    </script>
@endif
