<!-- /.container-fluid -->
<footer class="footer text-center"> © <?php echo $this->lang['copyright']; ?></footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

<!-- SunuFramework JavaScript -->
<script src="<?= ASSETS; ?>_main_/main.js"></script>

<!-- Telephone -->

<script src="<?= WEBROOT ?>assets/plugins/build/js/intlTelInput.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/js/waves.js"></script>

<!--Counter js -->
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>

<!--Morris JavaScript -->
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/raphael/raphael-min.js"></script>
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/morrisjs/morris.js"></script>
<!-- chartist chart -->
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- Calendar JavaScript -->
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/moment/moment.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/js/custom.min.js"></script>
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/js/dashboard1.js"></script>
<!-- Custom tab JavaScript -->
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/js/cbpFWTabs.js"></script>

<script src="<?= WEBROOT; ?>assets/plugins/jquery-timepicker-1.3.5/jquery.timepicker.min.js"></script>
<!-- Jquery-confirm JS -->
<script type="text/javascript" src="<?= ASSETS ?>plugins/jconfirm/js/jquery-confirm.js"></script>

<!-- CSS Validation -->
<script type="text/javascript" src="<?= WEBROOT; ?>assets/plugins/formValidation.min.js"></script>



<script type="text/javascript">

    $(document).on('click.bs.dropdown.data-api', '.mega-dropdown', function (e) {
        e.stopPropagation();
    });

    (function () {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
            new CBPFWTabs(el);
        });
        $('input[type="tel"]')
            .intlTelInput({
                utilsScript: '<?= WEBROOT ?>assets/plugins/build/js/utils.js',
                autoPlaceholder: true,
                preferredCountries: [ 'sn', 'gm', 'gb','ci'],
                initialDialCode: true,
                nationalMode: false
            });
    })();


</script>

<script src="<?= WEBROOT; ?>assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<!--Style Switcher -->
<script src="<?= WEBROOT; ?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<!-- Datatables JavaScript -->
<script src="<?= WEBROOT ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= WEBROOT ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?= WEBROOT ?>assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>

<!-- cashmanagemant JavaScript -->
<script src="<?= WEBROOT; ?>assets/js/main/main.js"></script>

<script src="<?= WEBROOT; ?>assets/js/jquery.validate.min.js"></script>
<script src="<?= WEBROOT; ?>assets/ampleadmin-minimal/js/mask.js"></script>



<script  src="<?= WEBROOT;?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= WEBROOT;?>assets/plugins/jquery-ui/insertion_document.js"></script>


<script src="<?= WEBROOT; ?>assets/plugins/jquery-wizard-master/jquery-wizard.min.js"></script>

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="<?= WEBROOT; ?>assets/plugins/jquery-wizard-master/formValidation.min.js"></script>
<script src="<?= WEBROOT; ?>assets/plugins/jquery-wizard-master/bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->

<!-- Sweet-Alert  -->
<script src="<?= WEBROOT ?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="<?= WEBROOT; ?>assets/js/jQuery.style.switcher.js"></script>



</body>

</html>