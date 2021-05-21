<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12"><?=@$maincontent?></div>
    <div class="col-md-3 hidden-sm hidden-xs">
        <?php if(has_content('aside_left')):?>
            <?php echo get_content('aside_left');?>
        <?php else:?>
            <?php $this->load->view('backend/aside/left');?>
        <?php endif;?>
    </div>
</div>