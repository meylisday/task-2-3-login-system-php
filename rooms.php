<?php require_once("header.php"); require_once("function.php");
session_start();
?>
<div class="container">
  <div style="display:none;"id="getidroom"><?php echo $_GET['id_room'];?></div>
    <div class="row">
    <div id="controls">
    Size:
    <select id="thickness" class="fixed">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
    </select>

    Color:
    <select id="color">
      <option value="#FFFFFF">Erase</option>
      <option value="#333333">#333333</option>
      <option value="#666666">#666666</option>
      <option value="#000000">#000000</option>
      <option value="#9BA16C">#9BA16C</option>
      <option value="#CC8F2B">#CC8F2B</option>
      <option value="#63631D">#63631D</option>
    </select>
  </div>
  
  <!--The canvas where drawings will be displayed-->
  <canvas id="canvas"></canvas>
  
  <!--A status text field, for displaying connection information-->
  <div id="status"></div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/index.js"></script>
<script type="text/javascript" src="http://unionplatform.com/cdn/OrbiterMicro_latest.js"></script>
<script type="text/javascript" src="assets/js/UnionDraw.js"></script>
</body>
</html>