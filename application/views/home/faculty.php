<body>
    <!-- About College -->
     <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="con-title">
                    <h2><span> <?php echo $branch_details->branch_name; ?></span></h2>
            </div>
            </div>
             <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-8">
        <div class="about-text">
          <span>HOD</span>
         <p class="text-justify">  
        <?php echo $branch_details->des; ?> 
         </p> 
        </div>
      </div>
      </div>
      </div>
    </section>
    <section>
        <div class="container com-sp pad-bot-70">
            <div class="row">
                <div class="con-title">
                    <h2><span> Faculties</span></h2>
                    <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th style="width:37%;">Faculty</th>
                        <th style="width:30%;">Designation</th>
                        <th style="width:36%;">Experience</th>
                        <th>Qualification</th>
                        <th>Email</th>
                        <th class="actions"></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach($teacher as $value): ?> 
                      <tr>
                        <td> <img class="materialboxed" height="100" width="100" src="<?=base_url('/teacherimages/'.$value->pic)?>" alt="<?=$value->name?>">
                          <?=$value->name?>
                        </td>
                        <td><?=$value->designation?></td>
                        <td><?=$value->bio?></td>
                        <td><?=$value->qua?></td>
                        <td><?=$value->email?></td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
      </div>
    </section>
