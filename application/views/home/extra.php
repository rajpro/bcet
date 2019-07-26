 <!-- About Transportation -->
<section>
   <?php foreach ($extras as $key => $value): ?>
    <div class="container com-sp pad-bot-70">
        <div class="row">
            <div class="con-title">
                <h2>About<span> <?=$value->title ?></span></h2>
                <p></p>
            </div>
        </div>
         <div class="row">
            <div class="col-md-4">
              <img height="300" width="70%" class="materialboxed" src="<?=base_url('/home_assets/images/'.$value->pic)?>" alt=""></td>
            </div>
            <div class="col-md-8">
              <div class="about-text">
                <p class="text-justify"><?=$value->content?></p>
                <p></p>
              </div>
            </div>
            </div>
            </div>
            <?php endforeach ?>
          </section>

   