 <!-- content-wrapper ends -->
 <!-- partial:partials/_footer.html -->
 <footer class="footer">
   <div class="d-sm-flex justify-content-center justify-content-sm-between">
     <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="#">PT Restu Prima Mandiri</a>. All rights reserved.</span>
     <!-- <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span> -->
   </div>
 </footer>
 <!-- partial -->
 </div>
 <!-- main-panel ends -->
 </div>
 <!-- page-body-wrapper ends -->
 </div>
 <!-- container-scroller -->
 <!-- plugins:js -->
 <script src="<?= base_url() ?>assets/admin/vendors/js/vendor.bundle.base.js"></script>
 <!-- endinject -->
 <!-- Plugin js for this page -->
 <script src="<?= base_url() ?>assets/admin/vendors/chart.js/Chart.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/vendors/progressbar.js/progressbar.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/vendors/jvectormap/jquery-jvectormap.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
 <script src="<?= base_url() ?>assets/admin/vendors/owl-carousel-2/owl.carousel.min.js"></script>
 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <script src="<?= base_url() ?>assets/admin/js/off-canvas.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/hoverable-collapse.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/misc.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/settings.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/todolist.js"></script>
 <!-- endinject -->
 <!-- Custom js for this page -->
 <script src="<?= base_url() ?>assets/admin/js/dashboard.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/alerts.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/toastr.js"></script>
 <script src="<?= base_url() ?>assets/admin/js_data/pegawai.js"></script>
 <script src="<?= base_url() ?>assets/admin/js_data/surat.js"></script>
 <script src="<?= base_url() ?>assets/admin/js_data/jabatan.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/jquery.dataTables.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/jszip.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/pdfmake.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/vfs_fonts.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/jquery-datatable/extensions/export/buttons.print.min.js"></script>
 <script src="<?= base_url() ?>assets/admin/js/tables/jquery-datatable.js"></script>
 <script src="<?= base_url() ?>assets/admin/moment.js"></script>
 <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
 <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

 <script>
   var text = document.getElementById("text");
   if (text != null) {
     var icon = document.getElementById("icon").innerHTML;
     var title = document.getElementById("title").innerHTML;
     swal({
       title: title,
       text: text.innerHTML,
       icon: icon,
     });
   }
 </script>
 <!-- End custom js for this page -->
 <script>
   var text_toastr = document.getElementById('text_toastr');
   if (text_toastr != null) {
     var type_toastr = document.getElementById('type_toastr').innerHTML;
     toastr.options = {
       "closeButton": false,
       "debug": false,
       "newestOnTop": false,
       "progressBar": false,
       "positionClass": "toast-bottom-right",
       "preventDuplicates": false,
       "onclick": null,
       "showDuration": "300",
       "hideDuration": "1000",
       "timeOut": "5000",
       "extendedTimeOut": "1000",
       "showEasing": "swing",
       "hideEasing": "linear",
       "showMethod": "fadeIn",
       "hideMethod": "fadeOut"
     };

     toastr.success(text_toastr.innerHTML);
   }
 </script>
 <script>
   $(function() {
     $('[data-toggle="tooltip"]').tooltip()
   })
 </script>
 <script type="text/javascript">
   $(document).ready(function() {
     $('input[name="datefilter[]"]').daterangepicker({
       autoUpdateInput: false,
       locale: {
         cancelLabel: 'Clear'
       }
     });

     $('input[name="datefilter[]"]').on('apply.daterangepicker', function(ev, picker) {
       $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
     });

     $('input[name="datefilter[]"]').on('cancel.daterangepicker', function(ev, picker) {
       $(this).val('');
     });
   })
  //  $(function() {



  //  });
 </script>

 </body>

 </html>