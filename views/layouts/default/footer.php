<!--begin footer -->
</div>
</div>
</div>
</div>
<div class="row-fluid">
    <div id="footer" class="span12"> 2018 &copy; <?php echo APP_NAME;?> <a href="<?php echo BASE_URL;?>"><?php echo COMPANY_NAME;?></a> </div>
</div>
<!--end footer -->

<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>


<!-- Load JS here for greater good =============================-->
<script src=<?php echo $_layoutParams['ruta_js']."excanvas.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.ui.custom.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."bootstrap.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.flot.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.flot.resize.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.peity.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."fullcalendar.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."maruti.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."maruti.dashboard.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."maruti.chat.js"?>></script>

</body></html>