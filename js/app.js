//   $(document).on('click', '#confirmLogOut', function(e) {
//     $.ajax({
//         type: 'post',
//         url: 'scripts/setLoggedOut.php',
//         data: {},

//         success: function (data) {}

//     })

//     $('#LoginBtn a').text('Login');
//     $('#LoginBtn a').attr('data-target','#myLoginModal');
//     $('#accountInfoBtn').attr('style', 'display:none;');
// });

//   $(document).on('click', '#log-in', function(e) {
//      $('#LoginBtn a').text('Login');
//      e.preventDefault();
//      $('#error-info').empty();
//      var userName = $('#myUserName').val();
//      var pass = $('#myPassword').val();
//      $.ajax({
//         type: 'post',
//         url: 'scripts/authenticate.php',
//         data: {'userName': userName, 'pass': pass},

//         success: function(data) {
//           var authData = JSON.parse(data);
//           if(authData[0] == "")
//           {
//             $('#error-info').append("<font color='red'><b>INVALID USERNAME</b></font>");
//         }
//         else if (authData[1] == "")
//         {
//             $('#error-info').append("<font color='red'><b>INVALID PASSWORD</b></font>");
//         }
//         else
//         {
//             $.ajax({
//                 type: 'post',
//                 url: 'scripts/setLoggedIn.php',
//                 data: {},

//                 success: function (data) {}

//             })

//            $('#LoginBtn a').text('Logout');
//            $('#LoginBtn a').attr('data-target','#logOutMessageModal');
//            $('#myLoginModal').modal('hide');
//            $('#accountInfoBtn').attr('style', '');
//        }
//    }

// })
//  });