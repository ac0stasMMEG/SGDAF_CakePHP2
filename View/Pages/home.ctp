<div class="row">
    <?php foreach($dashboards as $count => $dashboard): ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
        <a href="<?php echo '../'.$dashboard['Dashboard']['link']; ?>" class="small-box-footer">    
          <div class="<?php echo 'small-box '.$dashboard['Dashboard']['color']; ?>">
            <div class="inner">
              <h3><?php echo ++$count; ?></h3>
              <p><?php echo $dashboard['Dashboard']['name']; ?></p>
            </div>
            <div class="icon">
              <i class="<?php echo $dashboard['Dashboard']['icon']; ?>"></i>
            </div>
            <i class=""><br></i>
          </div>
              </a>
        </div>
        <!-- ./col -->
    <?php endforeach; ?>
</div>
