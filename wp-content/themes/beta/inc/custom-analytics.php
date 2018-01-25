<?php
if(!function_exists('org_analytics')):
function org_analytics(){
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-3960538-15', 'auto');
  ga('require', 'linker');
  ga('linker:autoLink', ['shop.yoga-gene.com','www.yoga-gene.com','c10.future-shop.jp','www.tokyo-yogawear.jp','www.ohanasmile.jp','www.ohanasmile.com'] );
  ga('send', 'pageview');

</script>

<?php
}
endif;
?>