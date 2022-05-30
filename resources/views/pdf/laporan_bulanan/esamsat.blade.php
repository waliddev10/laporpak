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
        padding: 5pt;
    }
</style>

<body>

    <h3 style="font-size: 12pt; text-align: center; margin: 0;">UPTD PPRD WILAYAH KAB. PENAJAM PASER UTARA</h3>
    <h3 style="font-size: 12pt; text-align: center; margin: 0;">SAMSAT PAYMENT POINT WARU</h3>
    <h3 style="font-size: 12pt; text-align: center; margin: 0 0 20pt 0;">BULAN APRIL 2022</h3>

    <table class="table" style="font-size: 10pt; width: 100%; border-collapse: collapse; margin: 0 0 20pt 0;">
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
        @foreach ($data as $d)
        <tr>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $loop->iteration }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{
                \Carbon\Carbon::parse($d->tgl_cetak)->format('d/m/Y') }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{
                \Carbon\Carbon::parse($d->tgl_bayar)->format('d/m/Y') }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $d->no_skpd }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $d->awalan_no_pol }} {{ $d->no_pol }} {{
                $d->akhiran_no_pol }}</td>
            <td style="border: 0.5pt solid black; text-align: center;">{{ $d->kasir_pembayaran->nama }}</td>
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
        @endforeach
    </table>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td>
                <div style="text-align: center;">
                    <div style="font-size: 10pt; margin: 10pt 0 60pt;">Kasi. Pendataan & Penetapan</div>

                    <h4 style="font-size: 10pt; margin: 0 0 3pt 0; text-decoration: underline;">Donny Marisya, SE</h4>
                    <h5 style="font-size: 10pt; font-weight: 10pt; margin: 0;">NIP. 19760201 200212 1 009</h5>
                </div>
            </td>
            <td>
                <div style="text-align: center;">
                    <span>Penajam, {{
                        \Carbon\Carbon::parse(now())->isoFormat('D MMMM Y') }}</span>

                    <div style="font-size: 10pt; margin: 10pt 0 60pt;">Pengelola Layanan Operasional</div>

                    <h4 style="font-size: 10pt; margin: 0 0 3pt 0; text-decoration: underline;">Muhammad Donny Dermawan,
                        A.Md.Pnl.
                    </h4>
                    <h5 style="font-size: 10pt; font-weight: 10pt; margin: 0;">NIP. 19991105 202201 1 002</h5>
                </div>
            </td>
        </tr>
    </table>


</body>