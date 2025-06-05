<x-home>
    <div>
        <script>
            var eventSource = new EventSource('/admin/laporan/sse');

            eventSource.onmessage = function(event) {
                console.log('Message received: ' + event.data);
            };
        </script>
    </div>
</x-home>