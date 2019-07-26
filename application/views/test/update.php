<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Update Test<span class="panel-subtitle"></span></div>
          <div class="panel-body">
            <?=form_open(base_url('test/update/'.$model->id))?>
              <div class="form-group col-md-4">
                <label>Test</label>
                <?=form_input('test_name',$model->test_name,['class'=>'form-control','placeholder'=>'Enter The Test'])?>
              </div>
              <div class="form-group col-md-4">
                <label>Marks</label>
                <?=form_input('mark',$model->mark,['class'=>'form-control','placeholder'=>'Enter Marks'])?>
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