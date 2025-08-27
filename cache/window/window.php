<script>
$('.toastclose').click(function(){
    $('.toast').fadeOut('fast',function(){
    	$('.message').fadeOut('fast');
    });
});
$(this).keydown( function(e) {
    var key = window.event?e.keyCode:e.which;
    if(key.toString() == "13"){
        return false;
    }
});
</script>
<div class="message w100 h100 fix">
    <div class='toast'>
        <div class="center">
        	<i class='fa <?php echo $this->vars["type"] ?>'></i>
            <p class="n">提示</p>
            <p class="msg"><?php echo $this->vars["msg"] ?></p>
            <div>
            	<a href="<?php echo $this->vars["url"] ?>" ><?php echo $this->vars["name"] ?></a>
            	<?php echo $this->vars["cancel"] ?>
            </div>
        </div>
    </div>
</div>