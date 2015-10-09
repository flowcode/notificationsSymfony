# notificationsSymfony
This is a bundle for notifications for symfony

To use mandrill we use HipMandrillBundle. 

ref: https://github.com/Hipaway-Travel/HipMandrillBundle
add this:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Hip\MandrillBundle\HipMandrillBundle(),
        );
    }

To yor config.yml
    hip_mandrill:
    api_key: "%mandrill_api_key%"
    disable_delivery: false
    default:
        sender: "%mandrill_api_key%"
        sender_name: "%mandrill_api_key%"
