<p>
	Hello <?= $nama; ?>,
</p>
<?php if($from == "new_marketing"): ?>
	<p>
		Selamat Bergabung di Discopery Property.<br>
		Semoga Sukses Selalu.
	</p>
<?php else: ?>
	<p>
		Pemberitahuan marketing baru <?= $new_marketing ?> telah bergabung di Discovery Marketing sebagai <?= $levelName ?> 
		berada dalam naungan Anda.<br>
		Selamat bekerjasama.
	</p>

<?php endif; ?>
<p>Terimakasih</p>