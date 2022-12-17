( function (window, document, $) {
     "use strict"

     $(function(){
          /* sweetalert & toast */
          const sideToast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000
          })
          /* sweetalert & toast */

          /* Server Side Table */
          $('#server_side').DataTable({
               "autoWidth": false,
               "pageLength": 10,
               "responsive": true,
               "processing": true,
               "serverSide": true,
               "order": [],
               "language": {
                    "processing": (`
                         <div class="spinner-loader">
                              <img src="${siteUrl('assets/public/images/loader.gif')}" width="25px" height="25px">
                              <div class="mt-1 font-small-1">Loading...</div>
                         </div>
                    `)
               },
               "ajax": {
                    "url": $('#server_side').data('url'),
                    "type": "post"
               },
               "columnDefs": [{
                    "target": [-1],
                    "orderable": false
               }]
          })
          /* Server Side Table */

          $(document).on('click', '.status-side', function () {
               Swal.fire({
                    title: $(this).data('message'),
                    icon: "warning",
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
               }).then((result) => {
                    if (result.isConfirmed) {
                         $.ajax({
                              method: 'post',
                              url: $(this).data('url'),
                              data: {
                                   id: $(this).data('id'),
                                   code: $(this).data('code'),
                              },
                              success: function (res) {
                                   reloadTables()
                                   var icon = res.response == 200 ? 'success' : 'error'
                                   sideToast.fire({
                                        icon: icon,
                                        title: res.message,
                                   })
                              }
                         }) //end ajax
                    }
               })
          })

          $(document).on('click', '.status-sides', function () {
               Swal.fire({
                    title: $(this).data('message'),
                    icon: "warning",
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
               }).then((result) => {
                    if (result.isConfirmed) {
                         $.ajax({
                              method: 'post',
                              url: $(this).data('url'),
                              data: {
                                   id: $(this).data('id'),
                                   code: $(this).data('code'),
                              },
                              success: function (res) {
                                   reloadTables()
                                   var icon = res.response == 200 ? 'success' : 'error'
                                   sideToast.fire({
                                        icon: icon,
                                        title: res.message,
                                   })
                              }
                         }) //end ajax
                    }
               })
          })
     
          $(document).on('click', '.delete-side', function () {
               Swal.fire({
                    title: $(this).data('message'),
                    icon: "warning",
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Ya",
                    cancelButtonText: "Tidak"
               }).then((result) => {
                    if (result.isConfirmed) {
                         $.ajax({
                              method: 'post',
                              url: $(this).data('url'),
                              data: {
                                   id: $(this).data('id')
                              },
                              success: function(res){
                                   reloadTables()
                                   var icon = res.response == 200 ? 'success' : 'error'
                                   sideToast.fire({
                                        icon: icon,
                                        title: res.message,
                                   })
                              }
                         })
                    }
               })
          })

          $(window).on('load', function () {
               console.clear()
          })
          
     })
})(window, document, jQuery)