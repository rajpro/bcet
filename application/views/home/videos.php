<!-- About College -->
<section>
    <div class="container com-sp pad-bot-70">
        <div class="row">
            <div class="con-title">
                <h2>Video<span> Gallery</span></h2>
                <p></p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($video as $key => $value):?>
            <div class="col-md-4">
              <iframe src="https://www.youtube.com/embed/<?=$value->content?>?rel=0&amp;showinfo=0" height="250" width='100%' frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
              <span><?=$value->title?></span>
            </div>
          <?php endforeach; ?>
        </div>
  </div>
</section>