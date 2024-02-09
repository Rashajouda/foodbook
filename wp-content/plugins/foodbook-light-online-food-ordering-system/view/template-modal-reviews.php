<script type="text/html" id="tmpl-fb_modal_reviews" >
  <div class="fb_steps_content step-reviews">
    <button class="review-back"><?php esc_html_e( 'Back', 'foodbooklite' ); ?></button>
    <div class="fb-product-reviews">
      <ul>
          {{{data.data}}}
      </ul>
    </div>
    <div class="fb-product-review-form ">
      <div class="fb-review-submit-message"></div>
      <# if( foodbookliteobj.is_login && data.isVerifiedOwner ){ #>
      <form action="<?php echo site_url( 'wp-comments-post.php' ); ?>" method="post" id="commentform" class="comment-form">
        <div class="comment-form-rating">
          <label for="rating"><?php esc_html_e( 'Your rating', 'foodbooklite' ); ?></label>
          <p class="stars fb-product-star">
            <span>
              <a data-rating="1" class="star-1" href="#"><?php esc_html_e( '1', 'foodbooklite' ); ?></a>
              <a data-rating="2" class="star-2" href="#"><?php esc_html_e( '2', 'foodbooklite' ); ?></a>              
              <a data-rating="3" class="star-3" href="#"><?php esc_html_e( '3', 'foodbooklite' ); ?></a>              
              <a data-rating="4" class="star-4" href="#"><?php esc_html_e( '4', 'foodbooklite' ); ?></a>              
              <a data-rating="5" class="star-5" href="#"><?php esc_html_e( '5', 'foodbooklite' ); ?></a>         
            </span>
            <input type="hidden" id="rating" name="rating" required />
          </p>
        </div>
        <p class="comment-form-comment">
          <label for="comment">
            <?php esc_html_e( 'Your review', 'foodbooklite' ); ?>&nbsp;<span class="required">*</span>
          </label>
          <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
        </p>
        <p class="form-submit">
          <input name="submit" type="submit" id="submit" class="submit" value="Submit"> 
          <input type="hidden" name="comment_post_ID" value="{{data.id}}" id="comment_post_ID">
          <input type="hidden" name="comment_parent" id="comment_parent" value="0">
          <?php wp_nonce_field( '_wp_unfiltered_html_comment_disabled','_wp_unfiltered_html_comment' ); ?>
        </p>
      </form>
      <# }else{ #>
      <p><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'foodbooklite' ); ?></p>
      <#}#>

    </div>
  </div>
</script>
