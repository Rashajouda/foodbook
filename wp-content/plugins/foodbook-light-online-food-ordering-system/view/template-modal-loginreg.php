<script type="text/html" id="tmpl-fb_loginreg">
  <div class="fb_steps_content step-loginreg">

    <div class="fb_card">
      <div class="fb_multiform">
        <!-- Form Selector Group -->
        <ul class="fb_list_unstyled fb_form_selector_list">
          <li class="fb_single_form_selector">
            <span class="fb_custom_checkbox">
              <label>
                <input
                  type="radio"
                  value="product_category"
                  name="fb_product_category"
                  data-form="fb_login_form"
                  checked
                />
                <span class="fb_label_title"><?php esc_html_e( 'Sign-In', 'foodbooklite' ); ?></span>
                <span class="fb_custom_checkmark"></span>
              </label>
            </span>
          </li>
          <li class="fb_single_form_selector">
            <span class="fb_custom_checkbox">
              <label>
                <input
                  type="radio"
                  value="product_category"
                  name="fb_product_category"
                  data-form="fb_signup_form"
                />
                <span class="fb_label_title"><?php esc_html_e( 'Sign-Up', 'foodbooklite' ); ?></span>
                <span class="fb_custom_checkmark"></span>
              </label>
            </span>
          </li>
        </ul>
        <!-- End Form Selector Group -->

        <!-- Single Form -->
        <div class="fb_single_form fb_login_form show">
          <form action="#" method="post" id="fb_form_log_in" class="form_log_in">
            <div class="fb_row">
              <div class="fb_col_md_6">
                <div class="fb_input_group">
                  <input
                    type="text"
                    id="fb_user_email"
                    class="fb_input_style"
                    name="uname"
                    required
                  />
                  <label
                    for="fb_user_email"
                    class="fb_input_label"
                    ><?php esc_html_e( 'username/email', 'foodbooklite' ); ?> <span>*</span></label
                  >
                </div>
              </div>
              <div class="fb_col_md_6">
                <div class="fb_input_group">
                  <input
                    type="password"
                    id="fb_user_password"
                    name="paw"
                    class="fb_input_style"
                    required
                  />
                  <label
                    class="fb_input_label"
                    for="fb_user_password"
                    ><?php esc_html_e( 'Password', 'foodbooklite' ); ?> <span>*</span></label
                  >
                </div>
              </div>
              <div class="fb_col_12">
                <input type="submit" class="fb_btn_fill" value="Login" />
                
              </div>
            </div>
            <?php wp_nonce_field( 'foodbooklite-login-nonce', 'security' ); ?>
          </form>
        </div>
        <!-- End Single Form -->

        <!-- Single Form -->
        <div class="fb_single_form fb_signup_form">
          <form action="#" method="post" id="fb_form_signup" class="form_log_in">
            <div class="fb_row">
              <div class="fb_col_md_4">
                <div class="fb_input_group">
                  <input
                    type="text"
                    id="fb_new_user_name"
                    class="fb_input_style"
                    name="username"
                    required
                  />
                  <label
                    for="fb_new_user_email"
                    class="fb_input_label"
                    ><?php esc_html_e( 'username', 'foodbooklite' ); ?><span>*</span></label
                  >
                </div>
              </div>
              <div class="fb_col_md_4">
                <div class="fb_input_group">
                  <input
                    type="text"
                    id="fb_new_user_email"
                    class="fb_input_style"
                    name="useremail"
                    required
                  />
                  <label
                    for="fb_new_user_email"
                    class="fb_input_label"
                    ><?php esc_html_e( 'email', 'foodbooklite' ); ?> <span>*</span></label
                  >
                </div>
              </div>
              <div class="fb_col_md_4">
                <div class="fb_input_group">
                  <input
                    type="password"
                    id="fb_new_user_password"
                    class="fb_input_style"
                    name="password"
                    required
                  />
                  <label
                    class="fb_input_label"
                    for="fb_new_user_password"
                    ><?php esc_html_e( 'Choose your Password', 'foodbooklite' ); ?> <span>*</span></label
                  >
                </div>
              </div>
              <?php wp_nonce_field( 'foodbooklite-signup-nonce', 'security' ); ?>
              <div class="fb_col_12">
                <button type="submit" class="fb_btn_fill"><?php esc_html_e( 'SignUp', 'foodbooklite' ); ?></button>
              </div>
            </div>
          </form>
        </div>
        <!-- End Single Form -->
      </div>
    </div>
  </div>
</script>