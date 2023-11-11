<?php 
    function formatHari($date) {
        $dateArr = explode(' ', $date);
        if ($dateArr[1] == '01') {
            $dateArr[1] = 'Januari';
        } elseif ($dateArr[1] == '02') {
            $dateArr[1] = 'Februari';
        } elseif ($dateArr[1] == '03') {
            $dateArr[1] = 'Maret';
        } elseif ($dateArr[1] == '04') {
            $dateArr[1] = 'April';
        } elseif ($dateArr[1] == '05') {
            $dateArr[1] = 'Mei';
        } elseif ($dateArr[1] == '06') {
            $dateArr[1] = 'Juni';
        } elseif ($dateArr[1] == '07') {
            $dateArr[1] = 'Juli';
        } elseif ($dateArr[1] == '08') {
            $dateArr[1] = 'Agustus';
        } elseif ($dateArr[1] == '09') {
            $dateArr[1] = 'September';
        } elseif ($dateArr[1] == '10') {
            $dateArr[1] = 'Oktober';
        } elseif ($dateArr[1] == '11') {
            $dateArr[1] = 'November';
        } elseif ($dateArr[1] == '12') {
            $dateArr[1] = 'Desember';
        }

        $dateStr = implode(' ', $dateArr);
        return $dateStr;
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kinerja Pegawai <?php echo $pegawai_info['nama_pegawai']; ?></title>
    <!-- Add this to your HTML's <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.2.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* font-size: 12px; */
        }

        #content-to-convert {
            width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        h1,
        h3,
        h5,
        h6 {
            text-align: center;
        }

        .row {
            margin-top: 20px;
        }

        .keclogo {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 0;
            font-weight: 600;
        }
        .keclogo2 {
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 0;
            /* font-weight: 600; */
        }

        .kablogo {
            font-size: 16px;
            margin-bottom: 0;
        }

        .alamatlogo {
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 0;
            text-align: left;
            font-weight: 600;
        }

        .kodeposlogo {
            font-size: 16px;
        }

        #tls {
            text-align: right;
        }

        .alamat-tujuan {
            margin-left: 50%;
        }

        .garis1 {
            border-top: 3px solid black;
            height: 2px;
            border-bottom: 1px solid black;
            border: 3px solid black;
        }

        #logo {
            display: block;
            margin: 0 auto;
        }

        #tempat-tgl {
            margin-left: 120px;
        }

        #camat {
            text-align: center;
        }

        #nama-camat {
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 100%;
        }

        td {
            padding: 4px;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        /* Your existing styles go here */
    </style>
</head>

<body>
    <center style="margin-top: 1%;">
        <button id="downloadPDF" class="btn btn-sm btn-danger">UNDUH PDF</button>
        <!-- <button id="downloadXLSX" class="btn btn-sm btn-success">UNDUH XLSX</button> -->
        <!-- <hr /> -->
    </center>

    <div id="content-to-convert">
        <header>
            <div class="row">
                <!-- <div id="img" class="col-md-4">
                    <img id="logo" src="{{ asset('img/logo.png') }}" width="auto" height="120" style="float: right;" />
                </div> -->
                <div id="text-header" class="col-md-12">
                    <h3 class="keclogo">Laporan Kinerja Pegawai</h3>
                    <h3 class="keclogo2">Periode: <?php echo $periode; ?></h3>
                </div>
                <div class="col-md-6 mt-4">
                    <h6 class="alamatlogo">Nama Lengkap: <?php echo $pegawai_info['nama_pegawai']; ?></h6>
                    <h6 class="alamatlogo">NIP: <?php echo $pegawai_info['nip_pegawai']; ?></h6>
                </div>
                <div class="col-md-6 mt-4">
                    <h6 class="alamatlogo" style="text-align: right;">Jabatan: <?php echo $pegawai_info['jabatan_detil']; ?></h6>
                    <h6 class="alamatlogo" style="text-align: right;">Divisi: <?php echo $pegawai_info['divisi']; ?></h6>
                </div>
            </div>
        </header>

        <hr class="garis1" />

        <div id="" class="table-responsive">
            <table class="table" style="font-size: 10px;">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Uraian</th>
                    <th>Keterangan</th>
                    <th>Target</th>
                    <th>Satuan</th>
                    <th>Hasil</th>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($datasets as $d) { ?>
                        <tr>
                            <td><?php echo $no;
                                $no++; ?></td>
                            <td><?php echo formatHari(date('d m Y', strtotime($d['waktu_selesai']))); ?></td>
                            <td><?php echo $d['uraian']; ?></td>
                            <td><?php echo $d['detil_kegiatan']; ?></td>
                            <td><?php echo $d['target']; ?></td>
                            <td><?php echo $d['satuan']; ?></td>
                            <td><?php echo $d['hasil_atasan']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div id="ttd" class="row">
            <div class="col-md-12 text-center mt-5 mb-5">
                Jakarta, <?php echo date('d').' '.$month_str.' '.date('Y'); ?>
            </div>
        </div>

        <div id="ttd" class="row">
            <div class="col-md-6">
                <!-- <p id="camat">Kepala UPTD Balai Latihan Kerja Dinas Tenaga Kerja, Perindustrian, Koperasi, Usaha Kecil
                    dan Menengah<br /><br /><br /><br /><br /><br /></p>
                <div id="nama-camat"><strong><u>EVITA DEWI,S.IP,M.M.</u></strong><br />
                    NIP. 19720217 199403 2 003
                </div> -->
            </div>
            <div class="col-md-12">
                <p id="camat">Mengetahui,<br /><br /><br /><br /><br /><br />
                </p>
                <div id="nama-camat"><strong><u><?php echo $atasan_info['nama_pegawai']; ?></u></strong><br />
                    NIP. <?php echo $atasan_info['nip_pegawai']; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to convert HTML to PDF
        function convertToPDF() {
            const content = document.getElementById('content-to-convert');

            html2canvas(content, {
                scale: 2 // Adjust scale as needed
            }).then(canvas => {
                window.jsPDF = window.jspdf.jsPDF;
                const imgData = canvas.toDataURL('image/png');
                // const pdf = new jsPDF('p', 'mm', 'a4');
                // const pdfWidth = pdf.internal.pageSize.getWidth();
                // const pdfHeight = pdf.internal.pageSize.getHeight();
                // const aspectRatio = canvas.width / canvas.height;
                // const imgHeight = pdfHeight;
                // const imgWidth = imgHeight * aspectRatio;
                // const offsetX = (pdfWidth - imgWidth) / 2; // Center horizontally
                // const offsetY = (pdfHeight - imgHeight) / 2; // Center vertically
                // pdf.addImage(imgData, 'PNG', offsetX, offsetY, imgWidth, imgHeight);
                // pdf.save('output.pdf');

                const pdf = new jsPDF('l', 'mm', 'a4'); // 'l' stands for landscape

                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                const aspectRatio = canvas.width / canvas.height;
                const imgHeight = pdfHeight;
                const imgWidth = imgHeight * aspectRatio;
                const offsetX = (pdfWidth - imgWidth) / 2; // Center horizontally
                const offsetY = (pdfHeight - imgHeight) / 2; // Center vertically
                pdf.addImage(imgData, 'PNG', offsetX, offsetY, imgWidth, imgHeight);
                pdf.save('Laporan Kinerja Pegawai <?php echo $pegawai_info['nama_pegawai']; ?> - Periode <?php echo $periode; ?>.pdf');
            });
        }

        // Function to convert HTML table with thead and title to XLSX
        function convertToXLSX() {
            // Select the table element
            const table = document.querySelector('table');

            // Get the title
            const title = "DAFTAR PESERTA PELATIHAN BERBASIS KOMPETENSI TAHUN {{ $year }}";

            // Get the table data as a 2D array
            const data = [];
            data.push([title]); // Add the title as the first row

            const headerRow = table.querySelector('thead tr');
            const headers = headerRow.querySelectorAll('th');
            const headerData = [];
            headers.forEach(header => {
                headerData.push(header.innerText);
            });
            data.push(headerData);

            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const rowData = [];
                const cells = row.querySelectorAll('td');
                cells.forEach(cell => {
                    rowData.push(cell.innerText);
                });
                data.push(rowData);
            });

            // Create a worksheet and add data
            const ws = XLSX.utils.aoa_to_sheet(data);

            // Create a workbook and add the worksheet
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            // Generate XLSX binary data
            const xlsxData = XLSX.write(wb, {
                bookType: 'xlsx',
                type: 'array'
            });

            // Convert to a Blob
            const blob = new Blob([new Uint8Array(xlsxData)], {
                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            });

            // Create a download link and trigger the download
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'DAFTAR PESERTA PELATIHAN BERBASIS KOMPETENSI TAHUN {{ $year }}.xlsx';
            document.body.appendChild(a);
            a.click();

            // Clean up
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }

        // Attach a click event to the button
        document.getElementById('downloadPDF').addEventListener('click', convertToPDF);

        // Attach a click event to the button
        document.getElementById('downloadXLSX').addEventListener('click', convertToXLSX);
    </script>
</body>

</html>