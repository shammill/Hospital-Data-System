<div class="panel panel-info portlet">
  <div class="panel-heading portlet-header">The Time</div>
  <div class="panel-body">
    <center><div id="time-span"></div></center>
  </div>
</div>
<script>
var el = document.getElementById('time-span')
setInterval(function() {
    var currentTime = new Date(),
        hours = currentTime.getHours(),
        minutes = currentTime.getMinutes(),
        ampm = hours > 11 ? 'PM' : 'AM';

    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;

    el.innerHTML = hours + ":" + minutes + " " + ampm;
}, 1000);
</script>
