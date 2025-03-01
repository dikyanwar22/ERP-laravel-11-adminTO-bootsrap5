<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Document</title>
    <style>
        @page {
            margin: 5mm 5mm 5mm 5mm;
            /* top, right, bottom, left */
        }

        /* General PDF styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header styling */
        .header {
            /* for repeating heder */
            /* position: fixed; */
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            /* text-align: center; */
            /* font-weight: bold; */
            border-bottom: 1px solid black;
        }

        /* Body content styling */
        .content {
            /* margin-top: 120px; */
            /* Adjust to prevent overlap with the header */
            padding: 20px;
        }

        /* Page break styling */
        .page-break {
            page-break-before: always;
        }

        table td {
            vertical-align: top;
        }

        .content-header {
            font-size: 14px;
        }

        #table-bundle {
            /* margin-top: 20px; */
            width: 100%;
            border-collapse: collapse;
        }

        #table-bundle tr th,
        #table-bundle tr td {
            border: 1px solid black;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            font-style: italic;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
</head>

<body>
    <footer>
        <div class="page-number">Page: </div>
    </footer>

    <!-- Header (repeated on every page) -->
    <div class="header">
        <table width="100%">
            <tr>
                <td>
                    <img style="max-width:110px; padding:0px;" src="https://cdn.vectorstock.com/i/1000v/54/10/laravel-php-web-framework-logo-vector-41005410.jpg">
                </td>
                <td style="text-align:center">
                    Nama Instansi Disini
                </td>
                <td align="right">
                <img style="max-width:110px; padding:0px;" src="https://cdn.vectorstock.com/i/1000v/54/10/laravel-php-web-framework-logo-vector-41005410.jpg">
                </td>
            </tr>
            <tr></tr>
        </table>
        <div style="position: absolute">
        </div>
    </div>

    <!-- Body content -->
    <div class="content">
        <table width="100%">
            <tr>
                <td width="50%" class="content-header">
                    <table width="100%">
                        <tr>
                            <td>Reference No</td>
                            <td>:&nbsp; fdfd</td>
                        </tr>
                        <tr>
                            <td>Order No</td>
                            <td>:&nbsp; 4343</td>
                        </tr>
                        <tr>
                            <td>Destination</td>
                            <td>:&nbsp; DC PANEL</td>
                        </tr>
                    </table>
                </td>
                <td width="50%" style="padding-left:80px;" class="content-header">
                    <table width="100%">
                        <tr>
                            <td>Date</td>
                            <td>:&nbsp; 4343</td>
                        </tr>
                        <tr>
                            <td>User</td>
                            <td>:&nbsp; fdfdf</td>
                        </tr>
                        <tr>
                            <td>Remark</td>
                            <td>:&nbsp; fg</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="margin-top:20px;padding-bottom:0px;font-style:bold;">To: DC Panel</div>
        <table width="100%" id="table-bundle">
            <tr>
                <th>Bundle No</th>
                <th>QR Main</th>
                <th>QR Bundle</th>
                <th>Product Code</th>
                <th>Style</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
            </tr>
 
        </table>

        <!-- Simulating a page break -->
        {{-- <div class="page-break"></div> --}}
    </div>
</body>

</html>
