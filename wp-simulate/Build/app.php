<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="TemplateData/style.css">
    <link rel="shortcut icon" href="TemplateData/favicon.ico" />
    <script src="TemplateData/UnityProgress.js"></script>
    <title>PlaygroundGroundIdeas : Builder</title>
    <style>
    /* a style sheet needs to be present for cursor hiding and custom cursors to work. */
    </style>
  </head>
  <body class="template" onload="resize_canvas()" onresize="resize_canvas()">
    <div class="template-wrap clear">
    <canvas class="emscripten" id="canvas" oncontextmenu="event.preventDefault()" height="720px" width="1280px"></canvas>
          <br>
    </div>
    <script type='text/javascript'>
  var Module = {
    TOTAL_MEMORY: 536870912,
    errorhandler: null,			// arguments: err, url, line. This function must return 'true' if the error is handled, otherwise 'false'
    compatibilitycheck: null,
    backgroundColor: "#222C36",
    splashStyle: "Light",
    dataUrl: "Release/PlaygroundBuild.datagz",
    codeUrl: "Release/PlaygroundBuild.jsgz",
    asmUrl: "Release/PlaygroundBuild.asm.jsgz",
    memUrl: "Release/PlaygroundBuild.memgz",
  };
</script>
<script src="Release/UnityLoader.js"></script>

        <script type="text/javascript">
          function resize_canvas(){
              canvas = document.getElementById("canvas");
                  var windowWidth = window.innerWidth - 100;
                  var windowHeight = window.innerHeight -100;
                  var scale;
                  scale = windowWidth / canvas.width;
                  if(canvas.height * scale > windowHeight){
                    scale = windowHeight / canvas.height;
                  }
                  canvas.width  = Math.round(canvas.width * scale);
                  canvas.height = Math.round(canvas.height * scale);
          }
        </script>
  </body>
</html>
