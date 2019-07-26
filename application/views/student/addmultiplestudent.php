<div class="be-content">
  <div class="main-content container-fluid">
    <?=$this->parser->parse('template/alert',[],TRUE);?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">Add  Multiple Student<span class="panel-subtitle"></span></div>
          <div class="panel-body">
          <?=form_open_multipart(base_url('student/addmultiplestudent'))?>
          <div class="form-group col-md-3">
            <label>Academic Year <span style="color:red;">*</span></label>
            <?=form_dropdown('academic_name',$academicyear,'',['class'=>'form-control input-sm','placeholder'=>'select any one'])?>
          </div>
          <div class="form-group col-md-3">
            <label>Course <span style="color:red;">*</span></label>
            <?=form_dropdown('course',$courses,'',['class'=>'form-control input-sm','placeholder'=>'select any one','onchange'=>'findBranch()','id'=>'cid'])?>
          </div>
          <div class="form-group col-md-3">
            <label>Branch <span style="color:red;">*</span></label>
           <div class="brn">
                <?=form_dropdown('branch',['Choose Branch'],'',['class'=>'form-control input-sm','placeholder'=>'select any one','id'=>'bid'])?>
              </div>
            </div>
            <!-- section start -->
              <div class="form-group col-md-3">
                  <label>Section  <span style="color:red;">*</span></label>
                     <?=form_dropdown('section',['0'=>'Choose one','A'=>'A','B'=>'B'],'A',['class'=>'form-control input-sm'])?>
                </div> 

               <!-- section edn -->
          <div class="form-group col-md-4">
            <label>Choose Excel File</label>
            <?=form_upload('excel','')?>
            <small class="text-danger">File Extension sould be .xls</small>
            <a href="<?=base_url('xlsx/sampleformat.xlsx')?>" title="">Sample Format</a>
          </div>
          </div>
          <div class="row xs-pt-15">
            <div class="col-xs-4">
            </div>
            <div class="col-xs-12">
              <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                <button class="btn btn-space btn-default">Cancel</button>
              </p>
            </div>
          </div>
          <?=form_close()?>
          </div>
        </div>
      </div>
     </div>
    </div>
   </div>
                