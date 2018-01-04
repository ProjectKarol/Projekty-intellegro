<?php

class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Projekty Logins', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'options_projeky' );
        ?>
        <div class="wrap">
            <h1>My Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'options_projeky', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Malile projektów', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'mail_admin', // ID
            'Mail Admin <->Login', // Title 
            array( $this, 'mail_admin_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'user_mail_1', 
            'Mail User 1 <->Login', 
            array( $this, 'user_mail_1_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );  



         add_settings_field(
            'user_mail_2', 
            'Mail User 2 <->Login', 
            array( $this, 'user_mail_2_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );     
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['mail_admin'] ) )
            $new_input['mail_admin'] = sanitize_text_field( $input['mail_admin'] );
        if( isset( $input['login_admin'] ) )
            $new_input['login_admin'] = sanitize_text_field( $input['login_admin'] );

        if( isset( $input['user_mail_1'] ) )
            $new_input['user_mail_1'] = sanitize_text_field( $input['user_mail_1'] );
         if( isset( $input['login_mail_1'] ) )
            $new_input['login_mail_1'] = sanitize_text_field( $input['login_mail_1'] );

         if( isset( $input['user_mail_2'] ) )
            $new_input['user_mail_2'] = sanitize_text_field( $input['user_mail_2'] );
        if( isset( $input['login_mail_2'] ) )
            $new_input['login_mail_2'] = sanitize_text_field( $input['login_mail_2'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function mail_admin_callback()
    {
        printf(
            '<input type="text" id="mail_admin" name="options_projeky[mail_admin]" value="%s" />',
            isset( $this->options['mail_admin'] ) ? esc_attr( $this->options['mail_admin']) : ''
        );
         printf(
            '<input type="password" id="login_admin" name="options_projeky[login_admin]" value="%s" />',
            isset( $this->options['login_admin'] ) ? esc_attr( $this->options['login_admin']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function user_mail_1_callback()
    {
        printf(
            '<input type="text" id="user_mail_1" name="options_projeky[user_mail_1]" value="%s" />',
            isset( $this->options['user_mail_1'] ) ? esc_attr( $this->options['user_mail_1']) : ''
        );
        printf(
            '<input type="password" id="login_mail_1" name="options_projeky[login_mail_1]" value="%s" />',
            isset( $this->options['login_mail_1'] ) ? esc_attr( $this->options['login_mail_1']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function user_mail_2_callback()
    {
        printf(
            '<input type="text" id="user_mail_2" name="options_projeky[user_mail_2]" value="%s" />',
            isset( $this->options['user_mail_2'] ) ? esc_attr( $this->options['user_mail_2']) : ''
        );
         printf(
            '<input type="password" id="login_mail_2" name="options_projeky[login_mail_2]" value="%s" />',
            isset( $this->options['login_mail_2'] ) ? esc_attr( $this->options['login_mail_2']) : ''
        );
    }

}

if( is_admin() )
    $my_settings_page = new MySettingsPage();




