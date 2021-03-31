<div id="footer" class="footer-basic">
    <footer>
        <p class="copyright">Paroxity © 2021</p>
        <p class="git">Build: <a id="git-hash" class="git" href="https://github.com/Paroxity/paroxity-econ-web/commit/<?php echo getGetHash(); ?>" target="_blank"><?php echo getGetHash(); ?></a></p>
    </footer>
</div>

<script src="<?php echo _resource("assets/js/jquery.min.js"); ?>"></script>
<script src="<?php echo _resource("assets/bootstrap/js/bootstrap.min.js"); ?>"></script>
<script src="<?php echo _resource("assets/js/bs-init.js"); ?>"></script>
<script src="<?php echo _resource("assets/js/custom.js"); ?>"></script>
<script src="<?php echo _resource("assets/js/table-custom.js"); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
</body>
</html>

<?php if(isConnected()): ?>

    <script>
        document.getElementById("connect-btn").style.display = "none";
        document.getElementById("disconnect-btn").style.display = "inherit";
    </script>

<?php else: ?>

    <script>
        document.getElementById("connect-btn").style.display = "inherit";
        document.getElementById("disconnect-btn").style.display = "none";
    </script>

<?php endif; ?>

<?php include "etc/flush.php"; ?>