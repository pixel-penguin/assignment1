<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Project</title>
	<style>
	
		#invoice{
			padding: 30px;
		}

		.invoice {
			position: relative;
			background-color: #FFF;
			min-height: 680px;
			padding: 15px
		}

		.invoice header {
			padding: 10px 0;
			margin-bottom: 20px;
			border-bottom: 1px solid #3989c6
		}

		.invoice .company-details {
			text-align: right
		}

		.invoice .company-details .name {
			margin-top: 0;
			margin-bottom: 0
		}

		.invoice .contacts {
			margin-bottom: 20px
		}

		.invoice .invoice-to {
			text-align: left
		}

		.invoice .invoice-to .to {
			margin-top: 0;
			margin-bottom: 0
		}

		.invoice .invoice-details {
			text-align: right
		}

		.invoice .invoice-details .invoice-id {
			margin-top: 0;
			color: #3989c6
		}

		.invoice main {
			padding-bottom: 50px
		}

		.invoice main .thanks {
			margin-top: -100px;
			font-size: 2em;
			margin-bottom: 50px
		}

		.invoice main .notices {
			padding-left: 6px;
			border-left: 6px solid #3989c6
		}

		.invoice main .notices .notice {
			font-size: 1.2em
		}

		.invoice table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			margin-bottom: 20px
		}

		.invoice table td,.invoice table th {
			padding: 15px;
			background: #eee;
			border-bottom: 1px solid #fff
		}

		.invoice table th {
			white-space: nowrap;
			font-weight: 400;
			font-size: 16px
		}

		.invoice table td h3 {
			margin: 0;
			font-weight: 400;
			color: #3989c6;
			font-size: 1.2em
		}

		.invoice table .qty,.invoice table .total,.invoice table .unit {
			text-align: right;
			font-size: 1.2em
		}

		.invoice table .no {
			color: #fff;
			font-size: 1.6em;
			background: #3989c6
		}

		.invoice table .unit {
			background: #ddd
		}

		.invoice table .total {
			background: #3989c6;
			color: #fff
		}

		.invoice table tbody tr:last-child td {
			border: none
		}

		.invoice table tfoot td {
			background: 0 0;
			border-bottom: none;
			white-space: nowrap;
			text-align: right;
			padding: 10px 20px;
			font-size: 1.2em;
			border-top: 1px solid #aaa
		}

		.invoice table tfoot tr:first-child td {
			border-top: none
		}

		.invoice table tfoot tr:last-child td {
			color: #3989c6;
			font-size: 1.4em;
			border-top: 1px solid #3989c6
		}

		.invoice table tfoot tr td:first-child {
			border: none
		}

		.invoice footer {
			width: 100%;
			text-align: center;
			color: #777;
			border-top: 1px solid #aaa;
			padding: 8px 0
		}

		@media print {
			.invoice {
				font-size: 11px!important;
				overflow: hidden!important
			}

			.invoice footer {
				position: absolute;
				bottom: 10px;
				page-break-after: always
			}

			.invoice>div:last-child {
				page-break-before: always
			}
		}
	</style>
</head>

<body>


	<!--Author      : @arboshiki-->
	<div id="app">
		<invoice-create></invoice-create>
	</div>
	
	
	<script src="/js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="/css/app.css" />
	
</body>
</html>
