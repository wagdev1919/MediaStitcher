<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Video Editor</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="css/styles.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body class="">
        <!-- START PAGE CONTAINER -->
        <div class="page-container">

            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <div class="page-title">
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Video Editor</h2>
                </div>
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Image & Audio Stitch</h3>
                                </div>
                                <div class="panel-body">
                                    <form id="frm-stitch-image-audio" role="form" class="form-horizontal" method="post" action="javascript:stitchImageAudio();">
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Image:</label>  
                                            <div class="col-md-2">
                                                <input type="file" name="file_image" id="file_image" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Audio:</label>  
                                            <div class="col-md-2">
                                                <input type="file" name="file_audio1" id="file_audio1" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label"></label>  
                                            <div class="col-md-2">
                                                <a target="__blank" id="stitch_image_audio"></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <button type="submit" id="btn-stitch-image-audio" class="btn btn-warning pull-right">Generate</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Video & Audio Stitch</h3>
                                </div>
                                <div class="panel-body">
                                    <form id="frm-stitch-video-audio" role="form" class="form-horizontal" method="post" action="javascript:stitchVideoAudio();">
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Video:</label>  
                                            <div class="col-md-2">
                                                <input type="file" name="file_video" id="file_video" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label">Audio:</label>  
                                            <div class="col-md-2">
                                                <input type="file" name="file_audio2" id="file_audio2" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-1 control-label"></label>  
                                            <div class="col-md-2">
                                                <a target="__blank" id="stitch_video_audio"></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <button type="submit" id="btn-stitch-video-audio" class="btn btn-warning pull-right">Generate</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->
                        </div>
                    </div>

                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <div class="modal fade" id="confirm-merge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Confirm Merge
                    </div>
                    <div class="modal-body">
                        Are you sure to replace audio with new one?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="doStitchVideoAudio(1);">Yes</button>
                        <button type="button" class="btn btn-default" onclick="doStitchVideoAudio(0);">No</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>

        <script type='text/javascript' src='js/plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='js/plugins/noty/layouts/topCenter.js'></script>
        <script type='text/javascript' src='js/plugins/noty/layouts/topLeft.js'></script>
        <script type='text/javascript' src='js/plugins/noty/layouts/topRight.js'></script>

        <script type='text/javascript' src='js/plugins/noty/themes/default.js'></script>
        <!-- END PAGE PLUGINS -->

        <!-- CONTROLLER -->
        <script type="text/javascript" src="js/app.js"></script>
        <!-- CONTROLLER -->

        <script type="text/javascript">
            var frm_stitch_image_audio_validate = $("#frm-stitch-image-audio").validate({
                ignore: [],
                rules: {
                        'file_image': {
                                required: true
                        },
                        'file_audio1': {
                                required: true
                        }
                    }
                });
            var frm_stitch_video_audio_validate = $("#frm-stitch-video-audio").validate({
                ignore: [],
                rules: {
                        'file_video': {
                                required: true
                        },
                        'file_audio2': {
                                required: true
                        }
                    }
                });
        </script>
    <!-- END SCRIPTS -->
    </body>
</html>
