# Overview #

This extension allows customers to always in touch with you. Provide them with proper
and convenient communication in channel that they are used to chat. 

### Features ###

* Grow sales with orders made via chat.
* Provide an easy way for your customers to reach you.
* Reduce abandoned carts with timely provided consultancy.
* Cut expenses on custom chat solutions

### Installation ###

1. Please run the following command
```shell
composer require thedevhub/messenger-widget
```

2. Update the composer if required
```shell
composer update
```

3. Enable module
```shell
php bin/magento module:enable DevHub_MessengerWidget
php bin/magento setup:upgrade
php bin/magento cache:clean
php bin/magento cache:flush
```
4. If your website is running on the production mode then you need to run the following command
```shell
php bin/magento setup:static-content:deploy
php bin/magento setup:di:compile
```

