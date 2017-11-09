<?php
/**
 * Template for displaying search forms in MedLabs
 *
 */
?>

<?php

$unique_id          = esc_attr( uniqid( 'search-form-' ) );
$placeholder_txt    = esc_attr_x( 'Enter search term(s)', 'placeholder', 'medlabs' );

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="form-container">
    <div class="form-control">
    	<label for="<?php echo $unique_id; ?>">
    		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'medlabs' ); ?></span>
    	</label>
  	   <input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo $placeholder_txt; ?>" value="" name="s"  />
    </div>
    <div class="form-control">
       <button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'medlabs' ); ?></span></button>
    </div>
  </div>
</form>
