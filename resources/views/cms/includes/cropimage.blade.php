<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="img-container" id="aspectRatio" aspect-ratio='{{ (isset($aspectRatio))? $aspectRatio: 16 / 9 }}'>
        <img loading="lazy" src="{{ $img }}" class="w-100">
      </div>
    </div>

  </div>

  <div class="row mt-3" id="actions">
    <div class="row justify-content-center d-flex docs-buttons">

      <div class="btn-group m-1">
        <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
            <span class="fa fa-arrows-alt"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
            <span class="fa fa-crop-alt"></span>
          </span>
        </button>
      </div>

      <div class="btn-group m-1">
        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
            <span class="fa fa-search-plus"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
            <span class="fa fa-search-minus"></span>
          </span>
        </button>
      </div>

      <div class="btn-group m-1">
        <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
            <span class="fa fa-arrow-left"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
            <span class="fa fa-arrow-right"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
            <span class="fa fa-arrow-up"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
            <span class="fa fa-arrow-down"></span>
          </span>
        </button>
      </div>

      <div class="btn-group m-1">
        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
            <span class="fa fa-undo-alt"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
            <span class="fa fa-redo-alt"></span>
          </span>
        </button>
      </div>

      <div class="btn-group m-1">
        <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
            <span class="fa fa-arrows-alt-h"></span>
          </span>
        </button>
        <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
            <span class="fa fa-arrows-alt-v"></span>
          </span>
        </button>
      </div>

      <div class="btn-group m-1">
        <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.reset()">
            <span class="fa fa-sync-alt"></span>
          </span>
        </button>

        <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
          <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
          <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
            <span class="fa fa-upload"></span> Upload
          </span>
        </label>

      </div>

      <div class="btn-group mx-1">

        <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getCroppedCanvas({ maxWidth: 4096, maxHeight: 4096 })">
            Save Cropped Image
          </span>
        </button>
      </div>

      <!-- Show the cropped image in modal -->
      <div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body"></div>
            <style media="screen">
              .modal-body canvas, .modal-body img{
                width: 100% !important;
              }
            </style>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue</button>
              <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download For Offline Use</a>
            </div>
          </div>
        </div>
      </div><!-- /.modal -->

    </div>

  </div>
</div>
