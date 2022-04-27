<div>
	<p class="bg-gray">
	Thank you for Buying Voucher from us!
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

	<p>You can check your voucher at: : </p>
	<center>
	<a href="<?= site_url("buy-voucher?s=".$data->Code); ?>" class="btn">View Voucher</a>
	</center>
	
	</p>
	<p>
		Have a problem or Have a Question?
		Contact Us :
	</p>
</div>