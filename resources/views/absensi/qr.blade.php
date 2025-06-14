<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('QR Code Absensi') }}
        </h2>
    </x-slot>

    <div class="py-10 flex justify-center">
        <div id="printArea" class="bg-white p-6 rounded shadow text-center w-full max-w-md">

            <h3 class="text-lg font-bold mb-4 border-b pb-2">QR Code untuk Absensi</h3>

            <div class="mb-4 flex justify-center">
                {!! QrCode::size(200)->generate($qrData) !!}
            </div>

            <div class="text-sm space-y-1">
                <p class="font-semibold">{{ $karyawan->nama_lengkap }}</p>
                <p>{{ $karyawan->jabatan ?? '-' }}</p>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-6 not-print">
        <button onclick="printDiv('printArea')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Cetak QR Code
        </button>
    </div>

    {{-- Script cetak --}}
    <script>
    function printDiv(divId) {
        const printContents = document.getElementById(divId).innerHTML;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(`
            <html>
            <head>
                <title>Cetak QR Code</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        font-family: Arial, sans-serif;
                    }
                    .print-container {
                        text-align: center;
                    }
                    h3 {
                        font-size: 20px;
                        margin-bottom: 16px;
                        border-bottom: 1px solid #ccc;
                        padding-bottom: 8px;
                    }
                    p {
                        margin: 4px 0;
                        font-size: 14px;
                    }
                </style>
            </head>
            <body>
                <div class="print-container">
                    ${printContents}
                </div>
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>


    {{-- Styling untuk print --}}
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .not-print,
            nav,
            header,
            footer {
                display: none !important;
            }

            #printArea {
                text-align: center;
                width: 100%;
                max-width: 100%;
                margin: 0 auto;
                padding: 0;
                box-shadow: none;
                border: none;
            }

            #printArea h3 {
                font-size: 18px;
                font-weight: bold;
                border-bottom: 1px solid #ccc;
                padding-bottom: 8px;
                margin-bottom: 16px;
            }

            #printArea p {
                margin: 4px 0;
                font-size: 14px;
            }
        }
    </style>
</x-app-layout>
