<div class="row">
    <div class="col-md-8"><?=@$maincontent?></div>
    <div class="col-md-4">
        <?php if(has_content('aside_left')):?>
            <?php echo get_content('aside_left');?>
        <?php else:?>
            <?php $this->load->view('backend/aside/left');?>
        <?php endif;?>
    </div>
</div>