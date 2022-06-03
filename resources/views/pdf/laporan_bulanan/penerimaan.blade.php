<style>
    @page {
        margin: 2cm;
    }

    body {
        font-size: 10pt;
    }

    table td,
    table td * {
        vertical-align: top;
    }

    .table tr,
    .table th,
    .table td {
        padding: 2pt;
    }
</style>

<body>

    <h3 style="font-size: 10pt; margin: 0;">REKAPITULASI PENERIMAAN
        @if($kasir->nama == 'Lokal')
        {{ ' PKB & BBNKB' }}
        @else
        {{ ' ' . Str::upper($kasir->nama) }} WILAYAH {{ Str::upper($wilayah->nama) }}
        @endif
    </h3>
    <h3 style="font-size: 10pt; margin: 0;">BADAN PENDAPATAN DAERAH PROVINSI KALIMANTAN TIMUR</h3>
    <h3 style="font-size: 10pt; margin: 0;">{{ Str::upper($payment_point->nama) }}</h3>
    <h3 style="font-size: 10pt; margin: 0 0 20pt 0;">BULAN {{
        Str::upper(\Carbon\Carbon::create()->month($bulan)->monthName) }} {{ $tahun }}</h3>

    <table class="table" style="font-size: 8pt; width: 100%; border-collapse: collapse; margin: 0 0 15pt 0;">
        <thead style="border-bottom: 4px solid black; border-bottom-style: double;">
            <tr>
                <th rowspan="3" style="border: 0.5pt solid black; width: 4%;">NO.</th>
                <th rowspan="3" style="border: 0.5pt solid black; width: 12%;">TANGGAL</th>
                <th colspan="4" style="border: 0.5pt solid black; width: 12%;">POKOK PKB</th>
                <th colspan="4" style="border: 0.5pt solid black; width: 12%;">DENDA PKB</th>
                <th rowspan="2" colspan="2" style="border: 0.5pt solid black; width: 10%;">JUMLAH</th>
            </tr>
            <tr>
                @foreach ($jenis_pkb as $jenis)
                <th colspan="2" style="border: 0.5pt solid black; width: 11%;">{{ Str::upper($jenis->nama) }}</th>
                @endforeach
                @foreach ($jenis_pkb as $jenis)
                <th colspan="2" style="border: 0.5pt solid black; width: 11%;">{{ Str::upper($jenis->nama) }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($jenis_pkb as $jenis)
                <th style="border: 0.5pt solid black; width: 11%;">UNIT</th>
                <th style="border: 0.5pt solid black; width: 11%;">RP</th>
                @endforeach
                @foreach ($jenis_pkb as $jenis)
                <th style="border: 0.5pt solid black; width: 11%;">UNIT</th>
                <th style="border: 0.5pt solid black; width: 11%;">RP</th>
                @endforeach
                <th style="border: 0.5pt solid black; width: 11%;">UNIT</th>
                <th style="border: 0.5pt solid black; width: 11%;">RP</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $d)
            @php
            $hitung_unit = 0;
            $hitung_rp = 0;
            @endphp
            <tr>
                {{-- 1 --}} <td style="border: 0.5pt solid black; text-align: center;">{{ $loop->iteration }}</td>
                {{-- 2 --}} <td style="border: 0.5pt solid black; text-align: center;">{{
                    \Carbon\Carbon::parse($key)->isoFormat('D MMMM Y') }}</td>
                @foreach ($jenis_pkb as $jj)
                @php
                $filtered_by_pkb = collect($d)->filter(function ($value, $key) use ($jj)
                { return $value->jenis_pkb_id == $jj->id; });
                @endphp
                <td style="border: 0.5pt solid black; width: 11%; text-align: center;">{{
                    !empty(count($filtered_by_pkb)) ? count($filtered_by_pkb) : ''
                    }}</td>
                <td style="border: 0.5pt solid black; width: 11%; text-align: right">{{
                    !empty($filtered_by_pkb->sum('nilai_pokok')) ?
                    number_format($filtered_by_pkb->sum('nilai_pokok'), 0, ',', '.') : '' }}
                </td>
                @php
                $hitung_unit = $hitung_unit + count($filtered_by_pkb);
                $hitung_rp = $hitung_rp + $filtered_by_pkb->sum('nilai_pokok');
                @endphp
                @endforeach
                @foreach ($jenis_pkb as $jj)
                @php
                $filtered_by_pkb_dan_denda = collect($d)->filter(function ($value, $key) use ($jj)
                { return $value->jenis_pkb_id == $jj->id && $value->nilai_denda > 0; });
                @endphp
                <td style="border: 0.5pt solid black; width: 11%; text-align: center;">{{
                    !empty(count($filtered_by_pkb_dan_denda)) ? count($filtered_by_pkb_dan_denda) : ''
                    }}</td>
                <td style="border: 0.5pt solid black; width: 11%; text-align: right">{{
                    !empty($filtered_by_pkb_dan_denda->sum('nilai_denda')) ?
                    number_format($filtered_by_pkb_dan_denda->sum('nilai_denda'), 0, ',', '.') : '' }}
                </td>
                @php
                $hitung_rp = $hitung_rp + $filtered_by_pkb_dan_denda->sum('nilai_denda');
                @endphp
                @endforeach
                {{-- 11 --}} <td style="border: 0.5pt solid black; text-align: center;">{{ $hitung_unit }}</td>
                {{-- 12 --}} <td style="border: 0.5pt solid black; text-align: right;">{{ number_format($hitung_rp, 0,
                    ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="12" style="border: 0.5pt solid black; text-align: center; font-style: italic;">
                    -- Nihil --
                </td>
            </tr>
            @endforelse
        </tbody>
        @if(!empty($data))
        <tfoot>
            <tr>
                <th colspan="2" style="border: 0.5pt solid black; text-align: center;">
                    JUMLAH
                </th>
                @php
                $hitung_totalnya_total_unit = 0;
                $hitung_totalnya_total_rp = 0;
                @endphp
                @foreach ($jenis_pkb as $jj)
                @php
                $hitung_total_unit_filtered_by_pkb = 0;
                $hitung_total_rp_filtered_by_pkb = 0;
                foreach($data as $d) {
                $filtered_by_pkb = collect($d)->filter(function ($value, $key) use ($jj)
                { return $value->jenis_pkb_id == $jj->id; });
                $hitung_total_unit_filtered_by_pkb = $hitung_total_unit_filtered_by_pkb + count($filtered_by_pkb);
                $hitung_total_rp_filtered_by_pkb = $hitung_total_rp_filtered_by_pkb +
                $filtered_by_pkb->sum('nilai_pokok');
                }
                @endphp
                <th style="border: 0.5pt solid black; width: 11%; text-align: center;">{{
                    $hitung_total_unit_filtered_by_pkb }}</th>
                <th style="border: 0.5pt solid black; width: 11%; text-align: right">{{
                    number_format($hitung_total_rp_filtered_by_pkb, 0,
                    ',', '.') }}</th>
                @php
                $hitung_totalnya_total_unit = $hitung_totalnya_total_unit + $hitung_total_unit_filtered_by_pkb;
                $hitung_totalnya_total_rp = $hitung_totalnya_total_rp + $hitung_total_rp_filtered_by_pkb;
                @endphp
                @endforeach
                @foreach ($jenis_pkb as $jj)
                @php
                $hitung_total_unit_filtered_by_pkb_dan_denda = 0;
                $hitung_total_rp_filtered_by_pkb_dan_denda = 0;
                foreach($data as $d) {
                $filtered_by_pkb_dan_denda = collect($d)->filter(function ($value, $key) use ($jj)
                { return $value->jenis_pkb_id == $jj->id && $value->nilai_denda > 0; });
                $hitung_total_unit_filtered_by_pkb_dan_denda = $hitung_total_unit_filtered_by_pkb_dan_denda +
                count($filtered_by_pkb_dan_denda);
                $hitung_total_rp_filtered_by_pkb_dan_denda = $hitung_total_rp_filtered_by_pkb_dan_denda +
                $filtered_by_pkb_dan_denda->sum('nilai_denda');
                }
                @endphp
                <th style="border: 0.5pt solid black; width: 11%; text-align: center;">{{
                    $hitung_total_unit_filtered_by_pkb_dan_denda }}</th>
                <th style="border: 0.5pt solid black; width: 11%; text-align: right">{{
                    number_format($hitung_total_rp_filtered_by_pkb_dan_denda, 0,
                    ',', '.')
                    }}</th>
                @endforeach
                <th style="border: 0.5pt solid black; text-align: center;">{{ $hitung_totalnya_total_unit }}</th>
                <th style="border: 0.5pt solid black; text-align: right;">{{ number_format($hitung_totalnya_total_rp, 0,
                    ',', '.') }}</th>
            </tr>
        </tfoot>
        @endif
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 30%;">
                <div style="text-align: center;">
                    <div style="font-size: 9pt; margin: 10pt 0 35pt;">{{ $penandatangan1->jabatan }}</div>

                    <h4 style="font-size: 9pt; margin: 0 0 3pt 0; text-decoration: underline;">{{ $penandatangan1->nama
                        }}</h4>
                    <h5 style="font-size: 9pt; font-weight: 10pt; margin: 0;">NIP. {{ $penandatangan1->nip }}
                    </h5>
                </div>
            </td>
            <td style="width: 40%;">
            </td>
            <td style="width: 30%;">
                <div style="text-align: center;">
                    <span style="font-size: 9pt;">{{ $kota_penandatangan->nama }}, {{
                        \Carbon\Carbon::parse($tgl_ttd)->isoFormat('D MMMM Y') }}</span>

                    <div style="font-size: 9pt; margin: 3pt 0 35pt;">{{ $penandatangan2->jabatan }}</div>

                    <h4 style="font-size: 9pt; margin: 0 0 3pt 0; text-decoration: underline;">{{
                        $penandatangan2->nama }}</h4>
                    <h5 style="font-size: 9pt; font-weight: 10pt; margin: 0;">NIP. {{ $penandatangan2->nip }}</h5>
                </div>
            </td>
        </tr>
    </table>


</body>