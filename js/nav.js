$(
  function()
  {
    $(".outPage").click(
      function()
      {
        if($(this).hasClass("canSele"))
        {
          window.location.href="?page="+$(this).attr("a1");
        }
      }
    )
  }
)
