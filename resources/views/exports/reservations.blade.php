<table style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th style="border: 1px solid #ccc; background-color: #f3f4f6; font-weight: bold;">Kendaraan</th>
            <th style="border: 1px solid #ccc; background-color: #f3f4f6; font-weight: bold;">Pemesan</th>
            <th style="border: 1px solid #ccc; background-color: #f3f4f6; font-weight: bold;">Waktu Mulai</th>
            <th style="border: 1px solid #ccc; background-color: #f3f4f6; font-weight: bold;">Waktu Selesai</th>
            <th style="border: 1px solid #ccc; background-color: #f3f4f6; font-weight: bold;">Keperluan</th>
            <th style="border: 1px solid #ccc; background-color: #f3f4f6; font-weight: bold;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $r)
            <tr>
                <td style="border: 1px solid #ccc;">{{ $r->vehicle->name ?? '-' }}</td>
                <td style="border: 1px solid #ccc;">{{ $r->user->name ?? '-' }}</td>
                <td style="border: 1px solid #ccc;">{{ \Carbon\Carbon::parse($r->start_time)->format('d-m-Y H:i') }}</td>
                <td style="border: 1px solid #ccc;">{{ \Carbon\Carbon::parse($r->end_time)->format('d-m-Y H:i') }}</td>
                <td style="border: 1px solid #ccc;">{{ $r->purpose }}</td>
                <td style="border: 1px solid #ccc; text-transform: capitalize;">{{ $r->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
