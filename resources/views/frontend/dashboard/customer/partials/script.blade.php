   <!-- javascript -->

   <script src="{{ asset('backend/assets') }}/js/jquery-3.7.1.min.js"></script>  
   <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>
   <script src="{{ asset('backend/assets') }}/js/plugins.js"></script>
   <script src="{{ asset('backend/assets') }}/js/main.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"
   integrity="sha256-BpyIV7Y3e2pnqy8TQGXxsmOiQ4jXNDTOTBGL2TEJeDY=" crossorigin="anonymous"></script>
<!-- for live notification -->
<script>
   function deleteNotification(id) {
       $.ajax({
           type: "DELETE",
           url: "{{ route('customer_or_contractor.notification.delete', ':id') }}".replace(':id', id),
           headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}",
           },
           success: function(resp) {
               flasher.success(resp.message);
               $("#notification_" + id).remove()
               let notificationCount = parseInt($("#notification-count").text());
               if (notificationCount > 0) {
                   $("#notification-count").text(notificationCount - 1);
               }
           },
           error: function(error) {
               flasher.error(error.responseJSON.message);
           }
       });
   }
   function deleteAllNotification() {
       $.ajax({
           type: "DELETE",
           url: "{{ route('customer_or_contractor.notification.deleteall') }}",
           headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}",
           },
           success: function(resp) {
               flasher.success(resp.message);
               $('#notification-list').empty();
               let notificationCount = parseInt($("#notification-count").text());
               if (notificationCount > 0) {
                   $("#notification-count").text(0);
               }
           },
           error: function(error) {
               flasher.error(error.responseJSON.message);
           }
       });
   }
   

   function markAllRead() {
       $.ajax({
           type: "POST",
           url: "{{ route('customer_or_contractor.notification.read') }}",
           headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}",
           },
           success: function(resp) {
               // flasher.success(resp.message);
               $('.notification-menu').removeClass('unseen');
               // $("#notification-indicator").remove()
               let notificationCount = parseInt($("#notification-count").text());
               if (notificationCount >= 0) {
                   $("#notification-count").text(0);
               }
           },
           error: function(error) {
               // flasher.error(error.responseJSON.message);
               console.log(error.responseJSON.message)
           }
       });
   }

   //realtime notification fetch
   document.addEventListener('DOMContentLoaded', function() {


       Echo.private('App.Models.User.' + {{ auth()->id() }})
           .notification((notification) => {
               console.log(notification);
               let notificationCount = parseInt($("#notification-count").text());
               if (notificationCount >= 0) {
                   $("#notification-count").text(notificationCount + 1);
               }
               // $('#notification-list').empty();
               $('#notification-list').prepend(`
                   <div class="notification-menu unseen" id="notification_${notification.id}" style="background-color: #f2ffe8;">
                       <a href="${notification.url}" class="dropdown-item">
                           <div class="d-flex align-items-center">
                               <div class="flex-shrink-0">
                                   <div class="d-flex align-items-center">
                                       <div class="rounded bg-light" style="width: 40px; height: 40px; overflow: hidden;">
                                           <img src="${notification.thumbnail ?? 'default-thumbnail.jpg'}" 
                                               alt="Notification Thumbnail" 
                                               class="img-fluid rounded">
                                       </div>
                                   </div>
                               </div>
                               <div class="flex-grow-1 ms-3">
                                   <p>${notification.title ?? 'Untitled Notification'}</p>
                                   <span style="background-color: red;border-radius: 50%;">New</span>
                                   
                               </div>
                           </div>
                       </a>
                   </div>
               `);
               flasher.info(notification.message, 'Notification');
           });
   })
</script>
   @stack('scripts')

