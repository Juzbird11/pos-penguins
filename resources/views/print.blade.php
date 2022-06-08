<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CH Service</title>
    <style>
        @page { 
            margin-top: 275px;
            margin-bottom: 150px; 
        }

        .header { 
            position: fixed;
            left: 0px; 
            top: -220px; 
            right: 0px; 
            height: 100px; 
        }

        .footer { 
            position: fixed;
            bottom: -90px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 15px;
        }

        .footer p {
            margin: 0;
        }

        .logo * {
            margin: 1px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .invoice {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .title {
            text-align: center!important;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .col-left {
            width: 70%;
            float: left;
        }

        .col-right {
            width: 30%;
            float: right;
        }

        .col-footer-right {
            width: 20%;
            float: right;
        }

        .border {
            border: 1px solid red;
        }

        .table {
            border-collapse: collapse !important;
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        .table thead th {
            background-color: #9096a1;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
        }

        .table-bordered {
            border: 1px solid black !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid rgb(47, 41, 41) !important;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-info th {
            text-align: left!important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-left {
            text-align: left !important;
        }

        .my-10 {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .my-5 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-30 {
            margin-top: 30px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-35 {
            margin-top: 35px;
        }

        .mt-50 {
            margin-top: 50px;
        }

        .mb-5 {
            margin-bottom: 30px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }

        .green {
            background-color: green;
            color: white;
        }

        .text-red {
            color: red;
        }

        .red {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1 class="text-red">ACG</h1>
            <h3>PC & LAPTOP</h3>
            <h3>SERVICE</h3>
        </div>
        <h2 class="invoice">INVOICE</h2>
        <div>
            <div class="col-left">
                <table class="table-info">
                    <tr>
                        <th>Invoice No.</th>
                        <td>:</td>
                        <td>{{ $sale->invoice_no }}</td>
                    </tr>
                    
                    <tr>
                        <th>Customer</th>
                        <td>:</td>
                        <td>{{ $sale->customer }}</td>
                    </tr>                    
                </table>
            </div>

            <div class="col-right">
                <table class="table-info">
                    <tr>
                        <th>Issue Date</th>
                        <td>:</td>
                        <td class="text-right">{{ $sale->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <div>
            <div class="col-left">
                <p>Please keep warranty card and vouncher to valid your warranty.</p>
                <p>Thank you for your bussiness.</p>
            </div>
            <div class="col-footer-right">
                <p>--------------------</p>
                <p>Authorized Sign</p>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-sm table-top">
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
            @foreach($sale->products as $product)
            <tr>
                <td>{{ $product->name  }}</td>
                <td class="text-right">{{ $product->pivot->price  }}</td>
                <td class="text-right">{{ $product->pivot->qty  }}</td>
                <td class="text-right">{{ $product->pivot->qty * $product->pivot->price  }}</td>
            </tr>
            @endforeach

            @foreach($sale->serviceFees as $fee)
            <tr>
                <td >{{ $fee->description }}</td>
                <td colspan="3" class="text-right">{{ $fee->fees }}</td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>              
                <td></td>  
                <th colspan="2" class="text-center">Total(mmk)</th>
                <th class="text-right">{{ $sale->total }}</th>
            </tr>
        </tfoot>
    </table>

    <script type="text/php">
        if ( isset($pdf) ) {
            $x = ($pdf->get_width() + 380) / 2;
            $y = $pdf->get_height() - 35;
            $text = "{PAGE_NUM} of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 10;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>
</html>