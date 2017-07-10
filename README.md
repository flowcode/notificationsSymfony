# notificationsSymfony
This is a bundle for notifications for symfony

To use mandrill we use Slot/MandrillBundle.

ref: https://github.com/slot/MandrillBundle
add this:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Slot\MandrillBundle\SlotMandrillBundle(),
        );
    }

To yor config.yml

    slot_mandrill:
        api_key: "%mandrill_api_key%"
        disable_delivery: true # useful for dev/test environment. Default value is 'false'
        # debug: passed to \Mandrill causing it to output curl requests. Useful to see output
        # from CLI script. Default value is 'false'
        debug: true
        default:
            sender: info@example.com
            sender_name: "%mandrill_api_key%" # Optionally define a sender name (from name)
            subaccount: Project # Optionally define a subaccount to use
        proxy:
            use: true # when you are behing a proxy. Default value is 'false'
            host: example.com
            port: 80
            user: john
            password: doe123
