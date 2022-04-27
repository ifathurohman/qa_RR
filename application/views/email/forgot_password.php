<p>
	<?= $nama; ?>
</p>
<p>
	<!-- Kami telah menerima permintaan anda untuk melakukan reset password. Silakan klik tombol di bawah untuk melanjutkan. -->
	We have received your request to reset the password. Please click the button below to continue.
</p>
<div style="text-align: center;padding: 10px;">
	<a href="<?= site_url("reset-password?e=".$email."&x=".$token); ?>" class="btn"><b>Reset Password</b></a>
</div>
<p>
	<span style="color: red;">* This email is only valid for 1 hour from now</span>
	<br>Ignore this email if you never ask to reset the password
</p>