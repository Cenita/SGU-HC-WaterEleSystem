$(
  function()
  {
    var count=0;
    $(".logoImg").click(
      function()
      {
        count++;
        $(this).rotate({animateTo:45*count});
      }
    )
  }
)
