amazon-ses-transport
====================

Amazon SES Transport Class for CakePHP

This is a plugin to send email with CakeEmail using AmazonSES service.

## Requirements

* CakePHP version 2.0 or later.
* Amazon SES account
* [AWS SDK for PHP 2](https://github.com/aws/aws-sdk-php)

## Installation

* Install AWS SDK for PHP to vendor directory
* Install AmazonSESTransport to plugin Directory

    cd app/Plugin
    git clone https://github.com/CriztianiX/amazon-ses-transport AmazonSESTransport

## Sample Code

    $email = new CakeEmail();
    $email->config(array(
        'transport' => 'AmazonSESTransport.AmazonSES',
        'log' => true,
        'Amazon.SES.Key' => 'Your AWS Key'
        'Amazon.SES.Secret' => 'Your AWS Secret Key'
    ));
    
    $email->sender('no-reply@example.org');
    $email->from('no-reply@example.org', 'Example');
    $email->to('test@example.org');
    $email->bcc('bcc@example.org');
    $email->subject('SES Test from CakePHP');
    
    $res = $email->send('test message.');

## Upgraded to AWS-PHP 2
[CriztianiX](cristianhaunsen@gmail.com)

## Author

[News2u Corporation](http://www.news2u.com)

