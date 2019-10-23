function stitchImageAudio() {
  var formData = new FormData($('#frm-stitch-image-audio')[0]);

  $("#stitch_image_audio").html("");
  $("#btn-stitch-image-audio").html("Stitching...");
  $.ajax({
    url : "api.php?command=stitch_image_audio",
    type : "post",
    data : formData,
    cache: false,
    contentType: false,
    processData: false,
    success : function(data){ 
      ret = { success:false };
      try{
        eval("ret=" + data + ";"); 
      }catch(e){}
  
      if (ret.success) {
        noty({text: 'Video is generated with image and audio.', layout: 'topRight', type: 'success', "timeout":10000});
        $("#stitch_image_audio").attr("href", ret.url);
        $("#stitch_image_audio").html(ret.url);
      } else {
        noty({text: ret.msg, layout: 'topRight', type: 'information', "timeout":10000});
      }
    },
    error : function() {
      noty({text: 'Stitching of image and audio is failed.', layout: 'topRight', type: 'error', "timeout":10000});
    },
    complete : function() {
      $("#btn-stitch-image-audio").html("Generate");
    }
  });
}

function stitchVideoAudio() {
  $("#confirm-merge").modal("show");
}

function doStitchVideoAudio(merge) {
  var formData = new FormData($('#frm-stitch-video-audio')[0]);

  $("#stitch_video_audio").html("");
  $("#btn-stitch-video-audio").html("Stitching...");
  $.ajax({
    url : "api.php?command=stitch_video_audio&merge=" + merge,
    type : "post",
    data : formData,
    cache: false,
    contentType: false,
    processData: false,
    success : function(data){ 
      ret = { success:false };
      try{
        eval("ret=" + data + ";"); 
      }catch(e){}
  
      if (ret.success) {
        if (merge == 1) {
          noty({text: 'Video is generated with video and audio.', layout: 'topRight', type: 'success', "timeout":10000});
        } else {
          noty({text: 'Video is generated with only video.', layout: 'topRight', type: 'success', "timeout":10000});
        }
        
        $("#stitch_video_audio").attr("href", ret.url);
        $("#stitch_video_audio").html(ret.url);
      } else {
        noty({text: ret.msg, layout: 'topRight', type: 'information', "timeout":10000});
      }
    },
    error : function() {
      noty({text: 'Stitching of video and audio is failed.', layout: 'topRight', type: 'error', "timeout":10000});
    },
    complete : function() {
      $("#btn-stitch-video-audio").html("Generate");
    }
  });
  $("#confirm-merge").modal("hide");
}