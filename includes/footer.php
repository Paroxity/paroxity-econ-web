<div class="footer-basic footer-edit" style="background: rgb(26,26,29);/*padding: 34px;*/">
	<footer>
		<p class="copyright">Paroxity © 2021</p>
	</footer>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>

<?php if(isConnected()): ?>

	<script type="text/javascript">
        document.getElementById("connect-btn").style.display = "none";
        document.getElementById("disconnect-btn").style.display = "inherit";
	</script>

<?php else: ?>

	<script type="text/javascript">
        document.getElementById("connect-btn").style.display = "inherit";
        document.getElementById("disconnect-btn").style.display = "none";
	</script>

<?php endif; ?>

<?php include "etc/flush.php"; ?>