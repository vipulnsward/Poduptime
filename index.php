<!doctype html><html><head><meta charset="utf-8"><title>Diaspora Pod uptime - Find your new social home</title>
<meta name="keywords" content="diaspora, podupti.me, diasp, diasporg, diasp.org, facebook, open source social, open source facebook, open source social network" />
<meta name="description" content="Diaspora Pod Live Status. diasp.org pod uptime monitor for Diaspora pods" />
<script type="text/javascript" src="/js/jquery-1.6.4.min.js"></script> 
<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script> 
<script type="text/javascript" src="/js/jquery.loading.1.6.4.min.js"></script> 
<script type="text/javascript" src="/js/jquery.tipsy.js"></script>
<script type="text/javascript" src="/js/podup.js"></script>
<script type="text/javascript" src="/vendor/facebox/src/facebox.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
<link rel="stylesheet" href="/css/newstyle.css" />
<link rel="stylesheet" href="/vendor/facebox/src/facebox.css" />

<?php include("vendor/Mobile_Detect.php");$detect = new Mobile_Detect();if ($detect->isMobile()) {echo '<link rel="stylesheet" href="/css/mobile.css" /><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';} ?>
<script type="text/javascript">
(function() {
var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
s.type = 'text/javascript';
s.async = true;
s.src = 'http://widgets.digg.com/buttons.js';
s1.parentNode.insertBefore(s, s1);
})();
</script></head>
<body>
  <header>
    <div class="page-header">
      <h1 id="title">
      DIASPORA* POD UPTIME
      </h1>
    <div class="row" id="buttonsy" style="display:none;">
<div class="span32">
    <div class="span2">
    <a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://podupti.me"></a>
    </div>
    <div class="span2">
          <img src="http://iliketoast.net/img/diasporaWebBadge80x15_3.png" border="0" onClick="dshare();">
      <script type="text/javascript">
      function dshare() {
         var url = window.location.href;
         var title = document.title;
         window.open('http://iliketoast.net/dshare.html?url='+encodeURIComponent(url)+'&title='+encodeURIComponent(title),'dshare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=400');
         return false;
      }
      </script>
    </div>
    <div class="span2">
    <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://podupti.me" data-text="Pod Uptime - Find a Diaspora Pod!" data-count="horizontal">Tweet</a
><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    </div>
    <div class="span3">
    <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fpodupti.me&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=recommend&amp;font
&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:130px; height:21px;" allowTransparency="true"></iframe>
    </div>
    <div class="span2">
    <a class="DiggThisButton DiggCompact"></a>
    </div>
    <div class="span2">
<img src="http://www.delicious.com/static/img/delicious.small.gif" height="10" width="10" alt="Delicious" />
        <a href="http://www.delicious.com/save" onclick="window.open('http://www.delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;">Delicious</a>
    </div>
    <div class="span2">
     <g:plusone></g:plusone>
      <script type="text/javascript">
        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
      </script>
    </div>
<div class="span2">
<script src="http://www.stumbleupon.com/hostedbadge.php?s=1"></script>
 </div>
<div class="span4" style="font-size:9px">
This site is a service of <a href="https://diasp.org">Diasp.org Pod</a><br>
</div>
</div>
    </div>
    </div>
  </header>
  <div class="container-fluid">
    <div class="sidebar"> 
      <div class="adsense"><script type="text/javascript">
      <!-- 
      google_ad_client = "ca-pub-3662181805557062"; 
      /* podup2 */ 
      google_ad_slot = "3334221511"; 
      google_ad_width = 200; 
      google_ad_height = 200; 
      //--> 
      </script> 
      <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script></div>
      <a href="https://market.android.com/details?id=appinventor.ai_david_morley.DiasporaPoduptime"><img src="/images/android-dude128.png"></a>
    </div>

    <div class="content">
      <div id="results">
        <?php include("show.php"); ?>
      </div>
      <div id="add">
        Pod Host? <u style="cursor: pointer; cursor: hand;">Click here</u> to manage your listing.<br>
        Our source is on <a href="https://github.com/diasporg/Poduptime">GitHub</a><br><br>
        Some pods are <a href="http://podupti.me/?hidden=true">Hidden</a> That have too many issues.<br><br>
      </div>
      <div id="howto" style="display:none; margin-left:50px">
        <br>
        Want your pod listed?<br>
        Its easy start monitoring on your pod with a free <a href="http://www.pingdom.com" target="new">www.pingdom.com</a> account.<br>
        <br>Make a public report public and then enter your URL below (note its the one you view after you goto it)<br><br>
        Pingdom shows me http://stats.pingdom.com/b4gasnh1c176 when I click it to goes to http://stats.pingdom.com/b4gasnh1c176/240588
        <br> So URL should look very close to this: http://stats.pingdom.com/b4gasnh1c176/240588<br>
        <br><form action="db/add.php" method="post">
        Stats URL:<input type="text" name="url" class="xlarge span8" placeholder="http://stats.pingdom.com/b4gasnh1c176/240588"><br>
        Pod domainname:<input type="text" name="domain" class="xlarge span4" placeholder="domain.com"><br>
        Your Email:<input type="text" name="email" class="xlarge span4" placeholder="user@domain.com"><br>
        <input type="submit" value="submit">
        </form>
        <br>Is your pod missing? If the server can not get a diaspora session its on the hidden list <a href="http://podupti.me/?hidden=true">Show</a>. This
is mostly because of selfsigned or openca certs, if you need a free ssl cert get one from startssl.com.
        <br>Need help? <a href="http://frodointernet.com/support">Support</a>
        <br>
      </div>
      <script type="text/javascript">
      var pkBaseURL = (("https:" == document.location.protocol) ? "https://frodointernet.com/s/" : "http://frodointernet.com/s/");
      document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
      </script><script type="text/javascript">
      try {
      var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 3);
      piwikTracker.trackPageView();
      piwikTracker.enableLinkTracking();
      } catch( err ) {}
      </script><noscript><p><img src="http://frodointernet.com/s/piwik.php?idsite=3" style="border:0" alt="" /></p></noscript>
      <script type="text/javascript">
      /* <![CDATA[ */
          (function() {
              var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
              s.type = 'text/javascript';
              s.async = true;
              s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
              t.parentNode.insertBefore(s, t);
          })();
      /* ]]> */
      </script>
    </div>
  </div>
</body>
</html>
