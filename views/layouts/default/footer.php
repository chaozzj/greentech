<!--begin footer -->
</div>
</div>
</div>
</div>
<div class="row-fluid">
    <div id="footer" class="span12"> 2018 &copy; <?php echo APP_NAME;?> <a href="<?php echo BASE_URL;?>"><?php echo APP_COMPANY;?></a> </div>
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

<script src=<?php echo $_layoutParams['ruta_js']."jquery.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.ui.custom.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.validate.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.dataTables.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."bootstrap.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.uniform.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."maruti.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."select2.min.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."maruti.form_common.js"?>></script>
<!--<script src=<?php echo $_layoutParams['ruta_js']."maruti.tables.js"?>></script>-->
<script src=<?php echo $_layoutParams['ruta_js']."bootstrap-datepicker.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."bootstrap-colorpicker.js"?>></script>
<script src=<?php echo $_layoutParams['ruta_js']."jquery.table2excel.js"?>></script>


<?php if(Sessions::get('level')=='Administrador'):?>
    <script type="text/javascript">
        $('#btnexport').click(function (){
            $('.table').table2excel({
                exclude: ".noExl",
                name:'GreenTech export',
                filename: "GreenTech",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            })
        })
    </script>
    <script src=<?php echo $_layoutParams['ruta_js']."maruti.popover.js"?>></script>
<?php endif;?>
<?php if(Sessions::get('level')<='Administrador'):?>
    <script src=<?php echo $_layoutParams['ruta_js']."maruti.popover.js"?>></script>
<?php endif;?>
</body></html>