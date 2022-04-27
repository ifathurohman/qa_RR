<div>
	<p class="bg-gray">
	Thank you for request to buy the voucher.
	<br/>
	You are already request to buy <?= $data->App; ?> Voucher at <?= date("d F Y",strtotime($data->Date)); ?>.
	</p>
	<b>Detail Purchase :</b> 
	<table class="table">
		<tr>
			<td style="width: 35%">Transaction Code</td>
			<td><?= $data->Code; ?></td>
		</tr>
		<tr>
			<td>Application</td>
			<td><?= $data->App; ?></td>
		</tr>
		<tr>
			<td>Package</td>
			<td><?= $data->Type; ?></td>
		</tr>
		<tr>
			<td>Quantity</td>
			<td><?= number_format($data->Qty,0,",","."); ?> Voucher</td>
		</tr>
		<tr>
			<td>Total Price</td>
			<td><?= "IDR ".number_format($data->Price,2,".",","); ?></td>
		</tr>
		<tr>
			<td>Total Price</td>
			<td><?= "IDR ".number_format($data->TotalPrice,2,".",","); ?></td>
		</tr>
	</table>
	<b>Transfer To:</b>
	<table class="table">
		<tr>
			<td style="width: 35%">Bank</td>
			<td><?= $data->Bank; ?></td>
		</tr>
		<tr>
			<td>Account Name</td>
			<td>CV. RC Electronic</td>
		</tr>
		<tr>
			<td>Account Number</td>
			<td>1234567890</td>
		</tr>
		<tr>
			<td>Transfer Amount</td>
			<td><?= "IDR ".number_format($data->TotalPrice,2,".",","); ?></td>
		</tr>
		
	</table>
	<p class="red_txt">Please make a payment before <?= date("d F Y",strtotime($data->ExpirePurchase)); ?>.</p>

	<p>If you are already paid please confirm your payment at : </p>
	<center>
	<a href="<?= site_url("buy-voucher?s=".$data->Code); ?>" class="btn">Confirmation Purchase</a>
	</center>
	
	</p>
	<p>
		Have a problem or Have a Question?
		Contact Us :
	</p>
</div>