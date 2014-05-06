$(function(){

  $("#generate_another").click(function( event ){

    event.preventDefault();
    $(".shorten_form, .generated_url").toggle();
    $("#shortening_form")[0].reset();

  });

  $("#generate").click(function( event ){

    event.preventDefault();

    var url = $("input[name=url]").val();
    var alias = $("input[name=alias]").val();

    if (url != ""){
      
      var query = "url="+url;
      if (alias != ""){ query += "&alias="+alias; }
      query += "&token=sausagebiscuit24";
      query += "&action=generate";

      $(".shorten_form, .processing").toggle();
      generate(query);

    } else {

      error("You need to enter a URL");

    }

  });

function generate( querystring ){

  $.ajax({
      url: "/api/v1.php?"+querystring,
      async: false
    }).done(function( data ) {
      
      var urlData = $.parseJSON( data );

      if (urlData.url){

        $(".processing, .generated_url").toggle();
        $("input[name=short-url]").val( urlData.url );

      } else {

        $(".shorten_form, .processing").toggle();
        error( urlData.note );

      }

    });

}

function error( msg ){
  $(".notification").find("p").html( msg );
  $(".notification").animate({"top":"0"});
  $(".notification").find("p").html( msg );
  $(".notification").delay(4000).animate({"top":"-100px"});
}

});

