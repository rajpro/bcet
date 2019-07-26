<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Update Notice<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open_multipart(base_url('notice/update/'.$model->id))?>
              <div class="form-group col-md-3">
                  <label>Notice Subject</label>
                 <?=form_input('notice_subject',$model->notice_subject,['class'=>'form-control datetimepicker','placeholder'=>'Enter notice Subject'])?>
                </div>
                div class="form-group col-md-3">
                  <label>Notice Content</label>
                  <input type="file" name="file_name" style="">
                  <span>or</span>
                 <?=form_textarea('notice_content',$model->notice_content,['class'=>'form-control datetimepicker','placeholder'=>'Enter notice content'])?>
                </div>
                div class="form-group col-md-3">
                  <label>Notice Date</label>
                 <?=form_input('notice_date',$model->notice_date,['class'=>'form-control datetimepicker','placeholder'=>'Enter notice date'])?>
                </div>
              <div class="form-group col-md-3">
                <label>Status</label>
                <?=form_dropdown('status',['active'=>'Active','deactive'=>'Deactive'],$model->status,['class'=>'form-control'])?>
              </div>
              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-4">
                </div>
                <div class="col-xs-4">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                    <button class="btn btn-space btn-default">Cancel</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>