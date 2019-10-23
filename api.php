<?php
  header('Access-Control-Allow-Origin: *');

  $command = $_REQUEST['command'];
  switch($command){
    case "stitch_image_audio":

      $image_file = $_FILES['file_image'];
      $audio_file = $_FILES['file_audio1'];

      if ($image_file == null || $image_file['size'] == 0) {
        echo "{ 'success': false, 'msg': 'Image file uploading is failed.' }";
        break;
      }

	  if ($audio_file == null || $audio_file['size'] == 0) {
        echo "{ 'success': false, 'msg': 'Audio file uploading is failed.' }";
        break;
      }

      $url_image = './tmp/' . md5(time() . $image_file["name"]) . "." . pathinfo($image_file["name"], PATHINFO_EXTENSION);
      if (!move_uploaded_file($image_file["tmp_name"], $url_image)) {
        echo "{ 'success': false, 'msg': 'Uploading error.' }";
        break;
      }

	  $url_audio = './tmp/' . md5(time() . $audio_file["name"]) . "." . pathinfo($audio_file["name"], PATHINFO_EXTENSION);
      if (!move_uploaded_file($audio_file["tmp_name"], $url_audio)) {
        echo "{ 'success': false, 'msg': 'Uploading error.' }";
        break;
      }

      $result = stitchImageWithAudio($url_image, $url_audio);
      @unlink($url_image);
      @unlink($url_audio);
      echo "{ 'success': true, 'msg': 'Video is generated successfully', 'url': '" . $result . "' }";
      break;

    case "stitch_video_audio":

      $file_video = $_FILES['file_video'];
      $file_audio = $_FILES['file_audio2'];
      $merge = $_REQUEST['merge'] + 0;

      if ($file_video == null || $file_video['size'] == 0) {
        echo "{ 'success': false, 'msg': 'Uploading error.' }";
        break;
      }

      $url1 = './tmp/' . md5(time() . $file_video["name"]) . "." . pathinfo($file_video["name"], PATHINFO_EXTENSION);
      if (!move_uploaded_file($file_video["tmp_name"], $url1)) {
        echo "{ 'success': false, 'msg': 'Uploading error.' }";
        break;
      }

      $url2 = '';
      if ($merge == 1) {
        if ($file_audio == null || $file_audio['size'] == 0) {
          echo "{ 'success': false, 'msg': 'Uploading error.' }";
          break;
        }
        $url2 = './tmp/' . md5(time() .$file_audio["name"]) . "." . pathinfo($file_audio["name"], PATHINFO_EXTENSION);
        if (!move_uploaded_file($file_audio["tmp_name"], $url2)) {
          echo "{ 'success': false, 'msg': 'Uploading error.' }";
          break;
        }
      }

      $result = stitchVideoWithAudio($url1, $url2, $merge);
      @unlink($urll);
      @unlink($url2);
      echo "{ 'success': true, 'msg': 'Video is generated successfully', 'url': '" . $result . "' }";
      break;

    default:
      echo "{ 'success': false, 'msg': 'invalid command' }";
  }

  function stitchImageWithAudio($image, $audio) {

    $filename = time() . ".mp4";
    $result = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . str_replace("api.php", "", explode("?", $_SERVER['REQUEST_URI'])[0]) . "videos/" . $filename;

    $original_max_exe_time = ini_get('max_execution_time');
    ini_set('max_execution_time', -1);
    $command = 'ffmpeg -loop 1 -i ' . $image . ' -i ' . $audio . ' -r 5 -map 0:v -map 1:a -c:v libx264 -c:a aac -strict -2 -pix_fmt yuva420p -shortest -f mp4 "./videos/' . $filename . '"';
    exec($command);
    ini_set('max_execution_time', $original_max_exe_time);
    return $result;
  }

  function stitchVideoWithAudio($video, $audio, $merge) {

    $filename = time() . ".mp4";
    $result = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . str_replace("api.php", "", explode("?", $_SERVER['REQUEST_URI'])[0]) . "videos/" . $filename;

    if ($merge == 1) {
      $original_max_exe_time = ini_get('max_execution_time');
      ini_set('max_execution_time', -1);
      $command = 'ffmpeg -i ' . $video . ' -i ' . $audio . ' -map 0:v -map 1:a -c:v libx264 -c:a aac -strict -2 -f mp4 "./videos/' . $filename . '"';
      exec($command);
      ini_set('max_execution_time', $original_max_exe_time);
    } else {
      $original_max_exe_time = ini_get('max_execution_time');
      ini_set('max_execution_time', -1);
      $command = 'ffmpeg -i ' . $video . ' -c:v h264 -c:a aac -strict -2 -f mp4 "./videos/' . $filename . '"';
      exec($command);
      ini_set('max_execution_time', $original_max_exe_time);
    }
    return $result;
  }
?>
