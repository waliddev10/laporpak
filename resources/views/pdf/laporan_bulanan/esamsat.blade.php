<style>
    @page {
        margin: 1cm 1.5cm;
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

    <h3 style="font-size: 11pt; text-align: center; margin: 0;">UPTD PPRD WILAYAH KAB. PENAJAM PASER UTARA</h3>
    <h3 style="font-size: 11pt; text-align: center; margin: 0;">SAMSAT {{ Str::upper($payment_point->nama) }}</h3>
    <h3 style="font-size: 11pt; text-align: center; margin: 0 0 20pt 0;">BULAN {{
        Str::upper(\Carbon\Carbon::create()->month($bulan)->monthName) }} {{ $tahun }}</h3>

    <table class="table" style="font-size: 9pt; width: 100%; border-collapse: collapse; margin: 0 0 20pt 0;">
        <tr style="border-bottom: 4px solid black; border-bottom-style: double;">
            <th style="border: 0.5pt solid black; width: 4%;">NO.</th>
            <th style="border: 0.5pt solid black; width: 12%;">TANGGAL CETAK<br />SKPD</th>
            <th style="border: 0.5pt solid black; width: 12%;">TANGGAL BAYAR</th>
            <th style="border: 0.5pt solid black; width: 12%;">NOMOR SKPD</th>
            <th style="border: 0.5pt solid black; width: 10%;">NOPOL</th>
            <th style="border: 0.5pt solid black; width: 11%;">KASIR</th>
            <th style="border: 0.5pt solid black; width: 13%;">POKOK</th>
            <th style="border: 0.5pt solid black; width: 13%;">DENDA</th>
            <th style="border: 0.5pt solid black; width: 13%;">JUMLAH</th>
        </tr>
        @forelse ($data as $d)
        <tr>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $loop->iteration }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{
                \Carbon\Carbon::parse($d->tgl_cetak)->format('d/m/Y') }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{
                \Carbon\Carbon::parse($d->tgl_bayar)->format('d/m/Y') }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $d->no_skpd }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $d->awalan_no_pol }} {{ $d->no_pol }} {{
                $d->akhiran_no_pol }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{ Str::upper($d->kasir_pembayaran->nama) }}</td>
            <td style="border: 0.5pt solid black;">
                <span style="float: left;">Rp</span>
                <span style="float: right;">{{ number_format($d->nilai_pokok, 0, ',', '.') }}</span>
                <div style="clear: both;"></div>
            </td>
            <td style="border: 0.5pt solid black;">
                <span style="float: left;">Rp</span>
                <span style="float: right;">{{ number_format($d->nilai_denda, 0, ',', '.') }}</span>
                <div style="clear: both;"></div>
            </td>
            <td style="border: 0.5pt solid black;">
                <span style="float: left;">Rp</span>
                <span style="float: right;">{{ number_format($d->nilai_pokok + $d->nilai_denda, 0, ',', '.') }}</span>
                <div style="clear: both;"></div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="border: 0.5pt solid black; text-align: center; font-style: italic;">
                -- Nihil --
            </td>
        </tr>
        @endforelse
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 30%;">
                <div style="text-align: center;">
                    <div style="font-size: 10pt; margin: 10pt 0 25pt;">{{ $penandatangan1->jabatan }}</div>

                    <h4 style="font-size: 10pt; margin: 0 0 3pt 0; text-decoration: underline;">{{ $penandatangan1->nama
                        }}</h4>
                    <h5 style="font-size: 10pt; font-weight: 10pt; margin: 0;">NIP. {{ $penandatangan1->nip }}
                    </h5>
                </div>
            </td>
            <td style="width: 40%;">
            </td>
            <td style="width: 30%;">
                <div style="text-align: center;">
                    <span>{{ $kota_penandatangan->nama }}, {{
                        \Carbon\Carbon::parse($tgl_ttd)->isoFormat('D MMMM Y') }}</span>

                    <div style="font-size: 10pt; margin: 2pt 0 25pt;">{{ $penandatangan2->jabatan }}</div>

                    <h4 style="font-size: 10pt; margin: 0 0 3pt 0; text-decoration: underline;">{{
                        $penandatangan2->nama }}</h4>
                    <h5 style="font-size: 10pt; font-weight: 10pt; margin: 0;">NIP. {{ $penandatangan2->nip }}</h5>
                </div>
            </td>
        </tr>
    </table>


</body>