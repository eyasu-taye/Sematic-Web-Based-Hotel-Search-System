<style>
table, th, td {
  border:1px solid black;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<form class="navbar-form" action="/search-cmc" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                      {{csrf_field()}}
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                      <input onkeyup="showcm()" id="nameinputid" type="text" class="form-control navbar-left" name="people" data-toggle="modal" data-target="#myModal1" placeholder="Search Hotel" style="display: inline; width: 350px; height: 30px; border-radius: 2px black;">
                        <button  id = "" class="btn btn-default" type="submit" disabled="true"style="background-color: #FFD700; width: auto; height: 30px; margin-bottom: 2px;"><span class="glyphicon glyphicon-search">Search</span>
                        </button>
                      </form>
                      <script type="text/javascript">
                    function showcm(){
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                  $.ajax({
                    /* the route pointing to the post function */
                    url: '/searchHotelByPrice',
                    type: 'POST',
                    data: {_token: CSRF_TOKEN,
                     keyword:$("#nameinputid").val(),
                     option:'Name',
                     ajaxflag:'request',},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                      // alert(data.Hotel_Name + " " + data.Hotel_Category + " " + data.Hotel_Price + "" + data.Hotel_City);
                        // alert(data.countHotel_Name);
                        $("#searchresultdisplay").html("<h4>Search Result</h4>");
                        $("#searchresultdisplay").append("<hr><table id='display' style='width:100%;background-color:white;'><tr><th>Hotel Name</th><th>Hotel Category</th><th>Hotel Price</th><th>Hotel City</th></tr></table>");
                        for(var i=1; i<data.countHotel_Name; i++){
                         
                          // document.getElementById("display").id = i +"display";
                          $("#display").append("<tr><td>"+data.Hotel_Name[i]+"</td><td>"+data.Hotel_Category[i]+"</td><td>"+data.Hotel_Price[i]+"</td><td>"+data.Hotel_City[i]+"</td></tr>");
                        }
                    },
                    error: function (xhr, status, error) {
                        // alert(xhr.responseText);
                                        },
                    complete: function(){
                    // Schedule the next request when the current one's complete
                    // setTimeout(checkcowor, 200000);
                  },
                })}
            </script>

  