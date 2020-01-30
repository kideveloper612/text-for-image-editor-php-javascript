<?php
 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

$imageEditor2Path = 'https://suncatcherstudio.com/image-text-editor-testing/';  

$imgPath = "blank.svg";
$newColor = "#dddddd";

$newFontColor = "#000000";
$newFontType = "sans-serif";

$newText1 = "Text1\nLine2";
$newTextSize1 = 25;
$fontWeight1 = 400;
$textBold1 = "no";

$newText2 = "Text2\nLine2";
$newTextSize2 = 25;
$fontWeight2 = 400;
$textBold2 = "no";


$newText3 = "";
$newTextSize3 = 30;
$startingX3 = 100;
$startingY3 = 100;

$heartVisible1 = "hide";
$heartScale1 = 1;
$heartTransformX1 = 25;
$heartTransformY1 = 25;

$heartVisible2 = "hide";
$heartScale2 = 1;
$heartTransformX2 = 100;
$heartTransformY2 = 25;

$textTransformX1 = 0;
$textTransformY1 = 0;
$textTransformX2 = 0;
$textTransformY2 = 0;
$textTransformX3 = 0;
$textTransformY3 = 0;

$newWidth = 1000;
$newHeight = 0;
$preserveAspectRatio = "yes";

$displayName = "yes";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data); 
  return $data;
}


//  Multi-line text is formatted in SVG using <tspan>
//  See the file "temp.html" for an example.  
//  This function takes something like: 
//  $data = "Text1\nLine2"
//     and converts it into:
//  $newStr = "Text1 <tspan x="11" dy="22">Line2</tspan>"
// 
//  It probably would be best to convert it to:
//   $newStr = "<tspan x="11" dy="22">Text1</tspan> <tspan x="11" dy="22">Line2</tspan>"
//  But then the drag operation does not work.
//
function convertTextToMultipleLines ($data, $x, $textSize) {
  // The first string is currently not in the <tspan> so that it can be dragged.
  $newStr = "";
  $lines = preg_split("/(\r\n|\n|\r)/",$data);
  for ($i = 0; $i < count($lines); $i++)  {
    $nextLine = ($lines[$i]);
    $nextLine = $nextLine . " ";  // If blank line, it still displays blank line.
    if ($i == 0) {
      $newStr =  $newStr . $nextLine;
    } else {
      // MAKE CHANGE HERE ??
      $newStr =  $newStr . "<tspan x=\"$x\" dy=\"$textSize\">$nextLine</tspan>";
      // $temp =  'data-tag="txt1" class="draggable txt1" ';
      // $newStr =  $newStr . "<tspan x=\"$x\" dy=\"$textSize\" $temp>$nextLine</tspan>";
    }
  }
  return $newStr;
}






if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
 
  if (!empty($_POST['imgPath'])) {
    $imgPath = test_input($_POST['imgPath']);
  }

  if (!empty($_POST['newColor'])) {
    $newColor = test_input($_POST['newColor']);
  }

  if (!empty($_POST['newFontColor'])) {
    $newFontColor = test_input($_POST['newFontColor']);
  }

  if (!empty($_POST["newFontType"])) {
    $newFontType = test_input($_POST["newFontType"]);
  } 


  if (!empty($_POST['newText1'])) {
    // Use the information in newText1.
    $newText1 = test_input($_POST['newText1']);
  } else {
    $newText1 = "";   // The textbox was empty;
  }

  if (!empty($_POST['newTextSize1'])) {
    $newTextSize1 = test_input($_POST['newTextSize1']);
  }

  if (!empty($_POST['textTransformX1'])) {
    $textTransformX1 = test_input($_POST['textTransformX1']);
  }

  if (!empty($_POST['textTransformY1'])) {
    $textTransformY1 = test_input($_POST['textTransformY1']);
  }

  if (isset($_POST["textBold1"])) {
    $textBold1 = "yes";
    $fontWeight1 = 800;
  }

 
  if (!empty($_POST['newText2'])) {
    // Use the information in newText2.
    $newText2 = test_input($_POST['newText2']);
  } else {
    $newText2 = "";   // The textbox was empty;
  }

  if (!empty($_POST['newTextSize2'])) {
    $newTextSize2 = test_input($_POST['newTextSize2']);
  }

  if (!empty($_POST['textTransformX2'])) {
    $textTransformX2 = test_input($_POST['textTransformX2']);
  }

  if (!empty($_POST['textTransformY2'])) {
    $textTransformY2 = test_input($_POST['textTransformY2']);
  }

  if (isset($_POST["textBold2"])) {
    $textBold2 = "yes";
    $fontWeight2 = 800;
  }


  if (!empty($_POST['newText3'])) {
    // Use the information in newText3.
    $newText3 = test_input($_POST['newText3']);
  } else {
    $newText3 = "";   // The textbox was empty;
  }

  if (!empty($_POST['newTextSize3'])) {
    $newTextSize3 = test_input($_POST['newTextSize3']);
  }

  if (!empty($_POST['textTransformX3'])) {
    $textTransformX3 = test_input($_POST['textTransformX3']);
  }

  if (!empty($_POST['textTransformY3'])) {
    $textTransformY3 = test_input($_POST['textTransformY3']);
  }



  if (!empty($_POST["heartVisible1"])) {
    $heartVisible1 = test_input($_POST["heartVisible1"]);
    if ($heartVisible1 == "hide") {
      $initialHeartValue1 = 'display:none;';
    } elseif ($heartVisible1 == "small") {
      $heartScale1 = 1;
    } else {
      $heartScale1 = 2;
    }
  }

  if (!empty($_POST['heartTransformX1'])) {
    $heartTransformX1 = test_input($_POST['heartTransformX1']);
  }

  if (!empty($_POST['heartTransformY1'])) {
    $heartTransformY1 = test_input($_POST['heartTransformY1']);
  }


  if (!empty($_POST["heartVisible2"])) {
    $heartVisible2 = test_input($_POST["heartVisible2"]);
    if ($heartVisible2 == "hide") {
      $initialHeartValue2 = 'display:none;';
    } elseif ($heartVisible2 == "small") {
      $heartScale2 = 1;
    } else {
      $heartScale2 = 2;
    }
  }

  if (!empty($_POST['heartTransformX2'])) {
    $heartTransformX2 = test_input($_POST['heartTransformX2']);
  }

  if (!empty($_POST['heartTransformY2'])) {
    $heartTransformY2 = test_input($_POST['heartTransformY2']);
  }

 
  if (!empty($_POST['newWidth'])) {
    $newWidth = test_input($_POST['newWidth']);
  }

  if (!empty($_POST['newHeight'])) {
    $newHeight = test_input($_POST['newHeight']);
  }

  if (!empty($_POST["displayName"])) {
    $displayName = test_input($_POST["displayName"]);
  }

  if (isset($_POST["preserveAspectRatio"])) {
    $preserveAspectRatio = "yes";
  } else {
    $preserveAspectRatio = "no"; 
  }  
  
}



  /* Error checking */
  if ($newWidth < 0) {
    $newWidth = 0;
  }

  if ($newHeight < 0) {
    $newHeight = 0;
  }

  if ($newWidth > 3000) {
    $newWidth = 3000;
  }

  if ($newHeight > 3000) {
    $newHeight = 3000;
  }

  if ($preserveAspectRatio == "no") {
    /* Use specified height and width */
  } else {
    /* Use larger value to determine size */
    if ($newWidth >= $newHeight) {
      $newHeight = 0;
    } else {
      $newWidth = 0;
    }
  }


  $svgFile = file_get_contents($imgPath);


  /* Find width and height of SVG file.    */
  /*   viewBox="0 0 208.25218 300.31232"   */
  preg_match ('/viewBox=\".*"/', $svgFile, $matches); 
  $viewBoxStr = $matches [0];
  $viewBoxStr = str_replace('"', ' ', $viewBoxStr);  
  $pieces = explode(" ", $viewBoxStr);
  $imgWidth = $pieces [3];
  $imgHeight = $pieces [4];

  /* echo '$imgWidth = ' . $imgWidth . "<br />";    */
  /* echo '$imgHeight = ' . $imgHeight . "<br />";  */ 

  $svgFile = str_replace("#dddddd", $newColor, $svgFile);

  if ($displayName == "no") {
    $svgFile = str_replace("SunCatcherStudio.com", "", $svgFile); 
  }


  $startingX1 = $imgWidth * 0.5;
  $startingY1 = $imgHeight * 0.25;

  $startingX2 = $imgWidth * 0.5;
  $startingY2 = $imgHeight * 0.5;

  $startingX3 = $imgWidth * 0.5;
  $startingY3 = $imgHeight * 0.75;


  $plainSvgFile = $svgFile;



  /* NOTE: Do NOT use the attribute "alignment-baseline".  */
  /* It is not consistent from one browser to the next.    */
  /* If problems develop in the future, try removing the   */
  /* attribute "text-anchor".                              */

  
  $multiLineText1 = convertTextToMultipleLines ($newText1, $startingX1, $newTextSize1); 
  $multiLineText2 = convertTextToMultipleLines ($newText2, $startingX2, $newTextSize2); 

  $strText1 = "";
  if (trim($newText1) != "") {
    $strText1 = "<text x=\"$startingX1\" y=\"$startingY1\" xml:space=\"preserve\"
      fill=\"$newFontColor\" font-size=\"$newTextSize1\" font-family=\"$newFontType\"
      style=\"font-weight:$fontWeight1\"
      transform=\"translate($textTransformX1, $textTransformY1)\"
      text-anchor=\"left\">$multiLineText1</text>";
  }

  $strText2 = "";
  if (trim($newText2) != "") {
    $strText2 = "<text x=\"$startingX2\" y=\"$startingY2\" xml:space=\"preserve\"
      fill=\"$newFontColor\" font-size=\"$newTextSize2\" font-family=\"$newFontType\"
      style=\"font-weight:$fontWeight2\"
      transform=\"translate($textTransformX2, $textTransformY2)\"
      text-anchor=\"left\">$multiLineText2</text>";
  }

  $strText3 = "";
  if (trim($newText3) != "") {
    $strText3 = "<text x=\"$startingX3\" y=\"$startingY3\" 
      fill=\"$newFontColor\" font-size=\"$newTextSize3\" font-family=\"$newFontType\"
      style=\"font-weight:400\"
      transform=\"translate($textTransformX3, $textTransformY3)\"
      text-anchor=\"middle\">$newText3</text>";
  }


  if (($heartVisible1 == "small") || ($heartVisible1 == "large")) {
    $strHeart1 ="<path transform=\"translate($heartTransformX1, $heartTransformY1) scale($heartScale1)\"
      style=\"fill:$newFontColor;\"
       d=\"M 32.488311,7.138465 C 29.888332,-0.13010867 20.387532,-0.63774646 16.859425,5.632564 11.061926,-1.5812053 2.8812042,1.0499858 1.2307279,7.504699 -0.48589112,14.898184 7.639329,22.455875 16.859619,29.807767 26.665269,22.505207 34.31532,14.251256 32.488515,7.137391 Z\"/>";
  } else {
    $strHeart1 = "";
  }


  if (($heartVisible2 == "small") || ($heartVisible2 == "large")) {
    $strHeart2 ="<path transform=\"translate($heartTransformX2, $heartTransformY2) scale($heartScale2)\"
      style=\"fill:$newFontColor;\"
       d=\"M 32.488311,7.138465 C 29.888332,-0.13010867 20.387532,-0.63774646 16.859425,5.632564 11.061926,-1.5812053 2.8812042,1.0499858 1.2307279,7.504699 -0.48589112,14.898184 7.639329,22.455875 16.859619,29.807767 26.665269,22.505207 34.31532,14.251256 32.488515,7.137391 Z\"/>";
  } else {
    $strHeart2 = "";
  }


  $strAll = "\n\n" . $strText1 . "\n\n" . $strText2 . "\n\n" . $strText3 . "\n\n" . $strHeart1 . "\n\n" . $strHeart2 . "\n\n";

  $svgFile = str_replace("</svg>", "$strAll </svg>", $svgFile); 



  if (isset($_POST['savePNG'])) {
    $im = new Imagick();
    /* To get transparent to work, I had to change the 
       image format FROM: PNG24   TO: PNG  */
   
    $im->setBackgroundColor(new ImagickPixel('transparent')); 
    $im->setSize($newWidth, $newHeight);
    $im->readImageBlob($svgFile);
 
    $im->setImageFormat("png");
    /* Pass zero as either parameter for proportional scaling. */ 
    $im->resizeImage($newWidth, $newHeight, imagick::FILTER_GAUSSIAN, 1);  
 
    $tmpName = tempnam(sys_get_temp_dir(), 'download');
    $file = fopen($tmpName, 'w');
    $im->writeImage($tmpName);
    $im->clear();
    $im->destroy();

    fclose($file);
    header('Content-Description: File Transfer');
    header('Content-Type: text/png');
    header('Content-Disposition: attachment; filename=download.png');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmpName));
    readfile($tmpName);
    unlink($tmpName);

    exit (); 
  }


  if (isset($_POST['saveJPG'])) {
    $im = new Imagick();
    $im->setSize($newWidth, $newHeight);
    $im->readImageBlob($svgFile);
    $im->setImageFormat("jpeg");
    /* Pass zero as either parameter for proportional scaling. */ 
    $im->adaptiveResizeImage($newWidth, $newHeight); 
 
    $tmpName = tempnam(sys_get_temp_dir(), 'download');
    $file = fopen($tmpName, 'w');
    $im->writeImage($tmpName);
    $im->clear();
    $im->destroy();

    fclose($file);
    header('Content-Description: File Transfer');
    header('Content-Type: text/jpg');
    header('Content-Disposition: attachment; filename=download.jpg');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmpName));
    readfile($tmpName);
    unlink($tmpName);

    exit (); 
  }



  if (isset($_POST['saveSVG'])) {
    $tmpName = tempnam(sys_get_temp_dir(), 'download');
    $file = fopen($tmpName, 'w');
    fwrite($file, $svgFile);

    fclose($file);
    header('Content-Description: File Transfer');
    header('Content-Type: text/svg');
    header('Content-Disposition: attachment; filename=download.svg');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmpName));
    readfile($tmpName);
    unlink($tmpName);

    exit (); 
  }


  if (isset($_POST['savePDF'])) {
    $im = new Imagick();
    $im->setResolution(300,300); 
    $im->setSize($newWidth, $newHeight);
    $im->readImageBlob($svgFile);

    $im->setImageFormat("pdf");
    /* Pass zero as either parameter for proportional scaling. */ 
    $im->adaptiveResizeImage($newWidth, $newHeight); 
 
    $tmpName = tempnam(sys_get_temp_dir(), 'download');
    $file = fopen($tmpName, 'w');
    $im->writeImage($tmpName);
    $im->clear();
    $im->destroy();

    fclose($file);
    header('Content-Description: File Transfer');
    header('Content-Type: text/pdf');
    header('Content-Disposition: attachment; filename=download.pdf');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmpName));
    readfile($tmpName);
    unlink($tmpName);

    exit (); 
  }


?>



<title>Online Image Editor (Add Text / Hearts to Your Image) </title>

<?php
// require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
// get_header ();
?>


<style type="text/css">

h1 {
  color: #8b4513;
  font-size:1.5em;
}

h3 {
  color: #8b4513;
  font-size:1.4em;
  font-weight: normal;
}


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  width:370px;
}

.dropdown-content form {
  color: black;
  padding: 5px; 
  text-decoration: none;
  display: inline;  /* Use block or inline to vary display. */
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}

a.donate { text-decoration: none; 
    border-radius: 10px;
    background-color: #008ddf;
    color: white;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 5px;
    padding-bottom: 5px;
   }

a.donate:hover { 
	background-color: #0870ac;
}

</style>


<div id="primary">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<h1 style="color: #8b4513; font-size:1.6em; display:inline;">Image Editor (Add Text / Hearts to Your Image) </h1>

<div style="clear:both; padding:4px; margin:0px;"> </div>


<h3 style="display:inline; style="display:block; padding:50px;">Step 1. Enter Your Text.</h3>
(<a style="color: #157DEC;" href="guide.php">Guide</a>)


<form method="post" name="imageTextEditor" id="imageTextEditor" 
action="<?php echo htmlspecialchars($imageEditor2Path);?>">


  <input type="hidden" name="imgPath" value="<?php echo $imgPath;?>" >
  <input type="hidden" name="newColor" value="<?php echo $newColor;?>" >

  <input type="hidden" name="newTextSize1" class="newTextSize1" value="<?php echo $newTextSize1;?>">
  <input type="hidden" name="textTransformX1" class="textTransformX1" value="<?php echo $textTransformX1;?>">
  <input type="hidden" name="textTransformY1" class="textTransformY1" value="<?php echo $textTransformY1;?>">

  <input type="hidden" name="newTextSize2" class="newTextSize2" value="<?php echo $newTextSize2;?>">
  <input type="hidden" name="textTransformX2" class="textTransformX2" value="<?php echo $textTransformX2;?>">
  <input type="hidden" name="textTransformY2" class="textTransformY2" value="<?php echo $textTransformY2;?>">

  <input type="hidden" name="newTextSize3" class="newTextSize3" value="<?php echo $newTextSize3;?>">
  <input type="hidden" name="textTransformX3" class="textTransformX3" value="<?php echo $textTransformX3;?>">
  <input type="hidden" name="textTransformY3" class="textTransformY3" value="<?php echo $textTransformY3;?>">

  <input type="hidden" name="heartScale1" class="heartScale1" value="<?php echo $heartScale1;?>">
  <input type="hidden" name="heartTransformX1" class="heartTransformX1" value="<?php echo $heartTransformX1;?>">
  <input type="hidden" name="heartTransformY1" class="heartTransformY1" value="<?php echo $heartTransformY1;?>">

  <input type="hidden" name="heartScale2" class="heartScale2" value="<?php echo $heartScale2;?>">
  <input type="hidden" name="heartTransformX2" class="heartTransformX2" value="<?php echo $heartTransformX2;?>">
  <input type="hidden" name="heartTransformY2" class="heartTransformY2" value="<?php echo $heartTransformY2;?>">





<div style="clear:both; padding:10px; margin:0px;"> </div>


<div style="float:left; padding:0px; margin:0px;">
<div style="float:left; padding:0 10px 0 10px;">  Text1: </div>
<div style="float:left; padding:0px;"> 
  <textarea id="newText1" class="newText1" style="display:block; width:200px; height:40px; margin:0px; padding:0px;" maxlength="5000" type="text" 
   name="newText1"><?php echo $newText1;?></textarea></div>

<div style="float:left; padding:0 2px 0 10px;"> 
Size: <input style="width:80px;" type="range" onchange="updateTextSize1(this.value)" class="textSize" name="textSize" min="10" max="90" value="<?php echo $newTextSize1;?>"></div>
<div style="float:left; padding:0 10px 0 0px;"> 
<input type="checkbox" onchange="updateFontWeight1(this.value)" id="textBold1"
  <?php if (isset($textBold1) && $textBold1=="yes") echo "checked";?>
  name="textBold1">Bold</div>
</div>


<div style="clear:both; padding:10px; margin:0px;"> </div>

<div style="float:left; padding:0px; margin:0px;">
<div style="float:left; padding:0 10px 0 10px;">  Text2: </div>
<div style="float:left; padding:0px;"> 
  <textarea id="newText2" class="newText2" style="display:block; width:200px; height:40px; margin:0px; padding:0px;" maxlength="5000" type="text" 
   name="newText2"><?php echo $newText2;?></textarea></div>
<div style="float:left; padding:0 2px 0 10px;"> 
Size: <input style="width:80px;" type="range" onchange="updateTextSize2(this.value)" class="textSize" name="textSize" min="10" max="90" value="<?php echo $newTextSize2;?>"></div>
<div style="float:left; padding:0 10px 0 0px;"> 
<input type="checkbox" onchange="updateFontWeight2(this.value)" id="textBold2"
  <?php if (isset($textBold2) && $textBold2=="yes") echo "checked";?>
  name="textBold2">Bold</div>
</div>


<div style="clear:both; padding:4px; margin:0px;"> </div>


<!-- 
&nbsp; <i class="tooltip">Text3: 
  <span class="tooltiptext">Enter a "dash" in this textbox - if you wish NO information to be displayed. 
Press the "Enter" key or the "Update" command button when finished.</span></i> 
<input class="newText3" style="width:130px;" maxlength="50" type="text" name="newText3" value="<?php echo $newText3;?>" > 
&nbsp;
Size: <input style="width:80px;" type="range" onchange="updateTextSize3(this.value)" class="textSize" name="textSize" min="10" max="90" value="<?php echo $newTextSize3;?>">
-->

&nbsp; Font: 
<input type="radio" name="newFontType" class="newFontType" 
  <?php if (isset($newFontType) && $newFontType=="serif") echo "checked";?> value="serif">Times

<input type="radio" name="newFontType" class="newFontType"
  <?php if (isset($newFontType) && $newFontType=="sans-serif") echo "checked";?> value="sans-serif">Arial


&nbsp; <input type="submit" name="button" value="Update Text">

<br> 

<div style="clear:both">&nbsp;</div>


&nbsp; &nbsp; <svg xmlns="http://www.w3.org/2000/svg" 
  width="<?php echo $imgWidth;?>" height="<?php echo $imgHeight;?>"
    onload="makeDraggable(evt)">

    <style>
      .static {
        cursor: not-allowed;
      }

      .draggable {
        cursor: move;
      }
 
    </style>

 
    <script type="text/javascript"><![CDATA[

      function makeDraggable(evt) {
        var svg = evt.target;
        svg.addEventListener('mousedown', startDrag);
        svg.addEventListener('mousemove', drag);
        svg.addEventListener('mouseup', endDrag);
        svg.addEventListener('mouseleave', endDrag);
        svg.addEventListener('touchstart', startDrag);
        svg.addEventListener('touchmove', drag);
        svg.addEventListener('touchend', endDrag);
        svg.addEventListener('touchleave', endDrag);
        svg.addEventListener('touchcancel', endDrag);


        function getMousePosition(evt) {
          var CTM = svg.getScreenCTM();
          if (evt.touches) { evt = evt.touches[0]; }
          return {
            x: (evt.clientX - CTM.e) / CTM.a,
            y: (evt.clientY - CTM.f) / CTM.d
          };
        }

        var selectedElement, offset, transform;

        function startDrag(evt) {
          if (evt.target.classList.contains('draggable') || evt.target.tagName == 'tspan') {
            if (evt.target.tagName === 'tspan') selectedElement = evt.target.parentElement;
            else selectedElement = evt.target;
            offset = getMousePosition(evt);
            // Make sure the first transform on the element is a translate transform
            var transforms = selectedElement.transform.baseVal;
            if (transforms.length === 0 || transforms.getItem(0).type !== SVGTransform.SVG_TRANSFORM_TRANSLATE) {
              // Create an transform that translates by (0, 0)
              var translate = svg.createSVGTransform();
              translate.setTranslate(0, 0);
              selectedElement.transform.baseVal.insertItemBefore(translate, 0);
            }
            console.log($('.draggable tspan'));
            // Get initial translation
            transform = transforms.getItem(0);
            offset.x -= transform.matrix.e;
            offset.y -= transform.matrix.f;
          }
        }



        function drag(evt) {
          if (selectedElement) {
            evt.preventDefault();
            var coord = getMousePosition(evt);
            if($(selectedElement).attr('data-tag')=='heart1'){
              $('.heartTransformX1').val(coord.x - offset.x);
              $('.heartTransformY1').val(coord.y - offset.y);
            }

            if($(selectedElement).attr('data-tag')=='heart2'){
              $('.heartTransformX2').val(coord.x - offset.x);
              $('.heartTransformY2').val(coord.y - offset.y);
            }

            if($(selectedElement).attr('data-tag')=='txt1'){
              $('.textTransformX1').val(coord.x - offset.x);
              $('.textTransformY1').val(coord.y - offset.y);
            }

            if($(selectedElement).attr('data-tag')=='txt2'){
              $('.textTransformX2').val(coord.x - offset.x);
              $('.textTransformY2').val(coord.y - offset.y);
            }

            if($(selectedElement).attr('data-tag')=='txt3'){
              $('.textTransformX3').val(coord.x - offset.x);
              $('.textTransformY3').val(coord.y - offset.y);
            }

           // MAKE CHANGE HERE ??
           // Something like? $(selectedElement).parent().transform.setTranslate(coord.x - offset.x, coord.y - offset.y);
           transform.setTranslate(coord.x - offset.x, coord.y - offset.y);

          }
        }


        function endDrag(evt) {
          selectedElement = false;
        }
      }
    ]]> </script>


  <?php echo $plainSvgFile?>

 
  <path data-tag="heart1" class="draggable heart1" id="outer"
    transform="translate(<?php echo $heartTransformX1;?>, <?php echo $heartTransformY1;?>) 
      scale(<?php echo $heartScale1;?>)"
    style="fill:<?php echo $newFontColor;?>; <?php echo $initialHeartValue1;?>"
     d="M 32.488311,7.138465 C 29.888332,-0.13010867 20.387532,-0.63774646 16.859425,5.632564 11.061926,-1.5812053 2.8812042,1.0499858 1.2307279,7.504699 -0.48589112,14.898184 7.639329,22.455875 16.859619,29.807767 26.665269,22.505207 34.31532,14.251256 32.488515,7.137391 Z"/>


  <path data-tag="heart2" class="draggable heart2" 
    transform="translate(<?php echo $heartTransformX2;?>, <?php echo $heartTransformY2;?>)
      scale(<?php echo $heartScale2;?>)"
    style="fill:<?php echo $newFontColor;?>; <?php echo $initialHeartValue2;?>"
     d="M 32.488311,7.138465 C 29.888332,-0.13010867 20.387532,-0.63774646 16.859425,5.632564 11.061926,-1.5812053 2.8812042,1.0499858 1.2307279,7.504699 -0.48589112,14.898184 7.639329,22.455875 16.859619,29.807767 26.665269,22.505207 34.31532,14.251256 32.488515,7.137391 Z"/>


  <text data-tag="txt1" id="txt1" class="draggable txt1" style="font-weight:<?php echo $fontWeight1;?>;"
    x="<?php echo $startingX1;?>" y="<?php echo $startingY1;?>" xml:space="preserve"
    fill="<?php echo $newFontColor;?>" font-size="<?php echo $newTextSize1;?>" 
    transform="translate (<?php echo $textTransformX1;?>, <?php echo $textTransformY1;?>)" 
    text-anchor="left"><?php if (trim($newText1) != '-') { echo $multiLineText1; }?></text>

  <text data-tag="txt2" class="draggable txt2" style="font-weight:<?php echo $fontWeight2;?>;"
    x="<?php echo $startingX2;?>" y="<?php echo $startingY2;?>" xml:space="preserve"
    fill="<?php echo $newFontColor;?>" font-size="<?php echo $newTextSize2;?>" 
    transform="translate (<?php echo $textTransformX2;?>, <?php echo $textTransformY2;?>)" 
    text-anchor="left"><?php if (trim($newText2) != '-') { echo $multiLineText2; }?></text>


  <text data-tag="txt3" class="draggable txt3" style="font-weight:400;"
    x="<?php echo $startingX3;?>" y="<?php echo $startingY3;?>" 
    fill="<?php echo $newFontColor;?>" font-size="<?php echo $newTextSize3;?>" 
    transform="translate (<?php echo $textTransformX3;?>, <?php echo $textTransformY3;?>)" 
    text-anchor="middle"><?php if (trim($newText3) != '-') { echo $newText3; }?></text>

</svg>



<div style="clear:both">&nbsp;</div>



<h3 style="display:inline;"> Step #2: Move / Drag and Drop the Objects. </h3> <br>
<p style="margin-left:20px;"> With your finger or mouse, you can optionally
<b>"Drag and Drop"</b> the <i>Text</i> placing it in different locations.</p>


<div style="clear:both">&nbsp;</div>


<h3 style="display:inline;"> Step #3: Optional Formatting. </h3>
<br>

&nbsp; Heart 1: 
<input type="radio" name="heartVisible1" value="small" 
  <?php if (isset($heartVisible1) && $heartVisible1=="small") echo "checked";?> value="small">Small

<input type="radio" name="heartVisible1" value="large" 
  <?php if (isset($heartVisible1) && $heartVisible1=="large") echo "checked";?> value="large">Large

<input type="radio" name="heartVisible1" value="hide" 
  <?php if (isset($heartVisible1) && $heartVisible1=="hide") echo "checked";?> value="hide">Hide

<br>

&nbsp; Heart 2: 
<input type="radio" name="heartVisible2" value="small" 
  <?php if (isset($heartVisible2) && $heartVisible2=="small") echo "checked";?> value="small">Small

<input type="radio" name="heartVisible2" value="large" 
  <?php if (isset($heartVisible2) && $heartVisible2=="large") echo "checked";?> value="large">Large

<input type="radio" name="heartVisible2" value="hide" 
  <?php if (isset($heartVisible2) && $heartVisible2=="hide") echo "checked";?> value="hide">Hide

<br>




&nbsp; Pattern color: <input type="color" name="newColor" onchange="reloadForm()" value="<?php echo $newColor;?>">
&nbsp; 
Font: <input type="color" name="newFontColor" onchange="reloadForm()" value="<?php echo $newFontColor;?>">
&nbsp; 
<input type="submit" name="button" value="Update">
<br>




<!-- This code must come after Heart Radio buttons. -->

<script type="text/javascript">

  $('.newText1').on('keyup',function () {
    // If only one line of text - update immediately.
    var temp = (document.getElementById("newText1").value);
    if (temp.indexOf("\n") == -1) {
      $('text.txt1').text($(this).val());
    }
  })
	
  $('.newText1').on('change',function () {
    // If multiple lines of text - reload form to create multiple <tspan> tags. 
    var temp = (document.getElementById("newText1").value);
    if (temp.indexOf("\n") >= 1) { 
      $('.newText1').val(val);
      reloadForm();
    } 
  })


  $('.newText2').on('keyup',function () {
    // If only one line of text - update immediately.
    var temp = (document.getElementById("newText2").value);
    if (temp.indexOf("\n") == -1) {
      $('text.txt2').text($(this).val());
    }
  })
	
  $('.newText2').on('change',function () {
    // If multiple lines of text - reload form to create multiple <tspan> tags. 
    var temp = (document.getElementById("newText2").value);
    if (temp.indexOf("\n") >= 1) { 
      reloadForm();
    } 
  })


			
  $('.newText3').on('keyup',function () {
    $('text.txt3').text($(this).val());
  })
			

  $('input[name=heartVisible1]').on('change',function() {
   var heartTransformX1= $('.heartTransformX1').val();		
   var heartTransformY1= $('.heartTransformY1').val();
   var selectedVal =  $('input[name=heartVisible1]:checked').val();
    if(selectedVal=='hide') {
      $('path.heart1').hide();
    } else if (selectedVal=='small') {
      $('path.heart1').show();
      $('path.heart1').attr("transform", "translate("+heartTransformX1+", "+heartTransformY1+") scale(1)");
      $('.heartScale1').val(1); 
    } else {
      $('path.heart1').show();
      $('path.heart1').attr("transform", "translate("+heartTransformX1+", "+heartTransformY1+") scale(2)");
      $('.heartScale1').val(2);
    }
  }).change();


  $('input[name=heartVisible2]').on('change',function() {
   var heartTransformX2= $('.heartTransformX2').val();		
   var heartTransformY2= $('.heartTransformY2').val();
   var selectedVal =  $('input[name=heartVisible2]:checked').val();
    if(selectedVal=='hide') {
      $('path.heart2').hide();
    } else if (selectedVal=='small') {
      $('path.heart2').show();
      $('path.heart2').attr("transform", "translate("+heartTransformX2+", "+heartTransformY2+") scale(1)");
      $('.heartScale2').val(1);
    } else {
      $('path.heart2').show();
      $('path.heart2').attr("transform", "translate("+heartTransformX2+", "+heartTransformY2+") scale(2)");
      $('.heartScale2').val(2);
    }
  }).change();


 function updateTextSize1(val) {
    $('text.txt1').attr('font-size',val);
    $('.newTextSize1').val(val);
    $('text.txt1').children('tspan').attr('dy',val);
  }

  function updateTextSize2(val) {
    $('text.txt2').attr('font-size',val);
    $('.newTextSize2').val(val);
    $('text.txt2').children('tspan').attr('dy',val);
  }

  function updateTextSize3(val) {
    $('text.txt3').attr('font-size',val);
    $('.newTextSize3').val(val);
  }
  
 
  function updateFontWeight1(val) {
    if (document.getElementById("textBold1").checked) {
      $('text.txt1').attr("style", "font-weight:800");
      $('.textBold1').val(800);
    } else {
      $('text.txt1').attr("style", "font-weight:400");
      $('.textBold1').val(400);
    }
  }

  function updateFontWeight2(val) {
    if (document.getElementById("textBold2").checked) {
      $('text.txt2').attr("style", "font-weight:800");
      $('.textBold2').val(800);
    } else {
      $('text.txt2').attr("style", "font-weight:400");
      $('.textBold2').val(400);
    } 
  }


  $('input[name=newFontType]').on('change',function() {
   var selectedFontVal =  $('input[name=newFontType]:checked').val();
    if(selectedFontVal=='serif') {
      $('text.txt1').attr('font-family','serif');
      $('text.txt2').attr('font-family','serif');
      $('text.txt3').attr('font-family','serif');
      $('.newFontType').val(val);
    } else {
      $('text.txt1').attr('font-family','sans-serif');
      $('text.txt2').attr('font-family','sans-serif');
      $('text.txt3').attr('font-family','sans-serif');
      $('.newFontType').val(val);
    }
  }).change();


  function reloadForm() {
    document.getElementById("imageTextEditor").submit();
  }

</script>



</script>



<div style="clear:both">&nbsp;</div>

<div class="content_hint"></div>

<div style="clear:both">&nbsp;</div>



<h3 style="display:inline;"> Step #4: Save Your New Image. </h3><br>
<p style="margin-left:20px;">
If saving in PNG, JPG, or PDF format, you may specify the desired width and height of your new 
design. 
SVG images can be scaled to any size after downloading.  
See the <a href="guide.php">Guide</a> for more details. 
</p>


&nbsp; &nbsp; Width: <input style="width:75px; height:25px; padding:5px; margin:5px;" 
type="text" name="newWidth" value="1000"> (pixels) &nbsp;
<i class="tooltip">Tips
  <span class="tooltiptext">
If "Preserve Aspect Ratio" is on, then set either the width OR the height of the image. 
</span>
</i>

<br>

&nbsp; &nbsp; Height: <input style="width:75px; height:25px; padding:5px; margin:5px;" type="text" name="newHeight" value=""><br />
&nbsp; &nbsp; <input type="checkbox" name="preserveAspectRatio" value="yes" checked>Preserve aspect ratio (proportional)</dd>
<br>

&nbsp; &nbsp; Include <i>SunCatcherStudio.com</i> on image: 
<input type="radio" name="displayName" value="yes" checked>Yes
<input type="radio" name="displayName" value="no">No
&nbsp; 
<i class="tooltip">Why?
  <span class="tooltiptext">This will help you remember where you can find more artwork in the future.</span>
</i>

<div style="clear:both">&nbsp;</div>

&nbsp; &nbsp; <a class="donate" href="https://suncatcherstudio.com/terms-and-pricing/">$ Donate / Purchase / Terms of Use</a>

<div style="clear:both">&nbsp;</div>

&nbsp; &nbsp; <input type="submit" name="savePNG" value="Save PNG Format">   
<input type="submit" name="saveJPG" value="Save JPG Format">  
<input type="submit" name="saveSVG" value="Save SVG Format">  
<input type="submit" name="savePDF" value="Save PDF Format">  

</form>


<br>
<br>


<h3 style="display:block;">Helpful Pointers / More Ideas. </h3>

Try the <a href="https://suncatcherstudio.com/stencil-maker/">Stencil Maker</a> to
create personalized word art or to create your own alphabet, letter, and number stencils.
Use the <a href="https://suncatcherstudio.com/monogram-maker/">Monogram Maker</a> to create
personalized monograms.
Find more <a href="https://suncatcherstudio.com/patterns/">patterns</a> and 
<a href="https://suncatcherstudio.com/stencils/">stencils</a>. 

<div style="clear:both">&nbsp;</div>

NOTE: If you experience any problems with this online image editor, please send 
a brief message to: <i>contact@suncatcherstudio.com</i> indicating what is not working.
Thank you.



<div style="clear:both">&nbsp;</div>

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/php-snippets/patterns-related-articles-snippet.html');?>

<div style="clear:both">&nbsp;</div>



</div>   <!-- end primary -->



<?php
get_sidebar ();
?>


<?php
get_footer (); 
?>

<br>
<br>

</body>

