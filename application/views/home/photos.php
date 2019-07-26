<!-- About College -->
<section>
    <div class="container com-sp pad-bot-70">
        <div class="row">
            <div class="con-title">
                <h2>About<span> Gallery</span></h2>
                <p></p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($gallery as $key => $value):?>
            <div class="col-md-3">
              <img class="materialboxed" data-caption="<?=$value->title?>" src="<?=base_url('home_assets/images/'.$value->pic)?>" height='200' width='100%'>
            </div>
          <?php endforeach; ?>
        </div>
  </div>
</section>