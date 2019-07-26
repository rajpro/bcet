<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Web Maintainence<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open_multipart(base_url('web/update/'.$model->id))?>
            <div class="form-group col-md-3">
                <label>Content Type</label>
                <?=form_input('con_type',$model->con_type,['class'=>'form-control input-sm','placeholder'=>'Enter about Content Type'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Title</label>
                <?=form_input('title',$model->title,['class'=>'form-control input-sm','placeholder'=>'Enter About Title'])?>
              </div>
              <div class="form-group col-md-3">
                <label>Title Content</label>
                <?=form_textarea('content',$model->content,['class'=>'form-control input-sm','placeholder'=>'Enter about Title Content'])?>
              </div>
              <div class="form-group col-md-3">
                 <label>Choose Pictures</label>
                <?=form_upload('pic','')?>
                <span class="small">Photos must be less than 1mb</span>
              </div>
              <div class="form-group col-md-3">
                 <label>Order</label>
                <?=form_input('sort',$model->sort,['class'=>'form-control input-sm','placeholder'=>'Enter Sorting Order'])?>
              </div>

              <div class="clearfix"></div>
              <div class="row xs-pt-15">
                <div class="col-xs-12">
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
                