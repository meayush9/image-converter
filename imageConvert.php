<?PHP 
function resize_image($file, $w, $h, $crop=FALSE) {
  list($width, $height) = getimagesize($file);
  $r = $width / $height;
  if ($crop) {
      if ($width > $height) {
          $width = ceil($width-($width*abs($r-$w/$h)));
      } else {
          $height = ceil($height-($height*abs($r-$w/$h)));
      }
      $newwidth = $w;
      $newheight = $h;
  } else {
      if ($w/$h > $r) {
          $newwidth = $h*$r;
          $newheight = $h;
      } else {
          $newheight = $w/$r;
          $newwidth = $w;
      }
  }
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  
  switch(strtolower($ext)){
    case "jpg":
      $src = imagecreatefromjpeg($file);
      break;
    case "png":
      $src = imagecreatefrompng($file);
      break;
    case "gif":
      $src = imagecreatefromgif($file);
      break;
    case "jpeg":
      $src = imagecreatefromjpeg($file);
      break;
    case "webp":
      $src = imagecreatefromwebp($file);
      break;
    case "avif":
      $src = imagecreatefromavif($file);
      break;
    default:
      echo "Invalid File formate";
      die;
  }
  $dst = imagecreatetruecolor($newwidth, $newheight);
  imageAlphaBlending($dst, true);
  imageSaveAlpha($dst, true);
  imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  
  return $dst;  
}

function renderImage($dst, $outputFormat = 'jpeg', $output = null, $quality = 7){
  switch(strtolower($outputFormat)){
    case "jpg":
      if(empty($output)){
        $quality = $quality*10;
        Header('Content-type: image/jpeg');
      }
      imagejpeg($dst, $output, $quality);
      break;
    case "png":
      if(empty($output)){
        Header('Content-type: image/png');
      }
      imagepng($dst, $output, $quality);
      break;
    case "gif":
      if(empty($output)){
        Header('Content-type: image/gif');
      }
      imagegif($dst, $output);
      break;
    case "webp":
      if(empty($output)){
        Header('Content-type: image/webp');
      }
      imagewebp($dst, $output, $quality);
      break;
    case "avif":
      if(empty($output)){
        Header('Content-type: image/avif');
      }
      imageavif($dst, $output, $quality);
      break;
    default:
      echo "Invalid File formate";
      die;
  }
}


$img = resize_image("sample.png", 500, 500); //This function Resize or crop the image and return the image object
renderImage($img, 'gif'); // This function will render image to new formate or output to new location
?>
