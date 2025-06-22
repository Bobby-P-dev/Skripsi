<x-home>
    <div>
        @foreach($data as $penugasan)
        <h1>{{ $penugasan->laporan_uuid }}</h1>
        <h1>{{ $penugasan->teknisi_id}}</h1>
        <h1>{{ $penugasan->admin_id}}</h1>
        <h1>{{ $penugasan->tenggat_waktu}}</h1>
        <h1>{{ $penugasan->catatan}}</h1>
        <h1>{{ $penugasan->tenggat_waktu}}</h1>
        <h1>{{ $penugasan->tenggat_waktu}}</h1>
        @endforeach
    </div>
</x-home>