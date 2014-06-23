<?php
/** 
 * Send mail using Amazon SES service
 *
 * This depends on AWS SDK for PHP 2 (https://github.com/aws/aws-sdk-php).
 *
 * @copyright Copyright 2012 News2u Corporation
 * @link http://www.news2u.co.jp/
 * @since CakePHP v2.0.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AbstractTransport', 'Network/Email');
use Aws\Ses\SesClient;

/**
 * Send mail using Amazon SES service
 * 
 * @package Cake
 * @subpackage Lib.Network.Email
 */
class AmazonSESTransport extends AbstractTransport {

/**
 * Send mail
 *
 * @param CakeEmail $email CakeEmail
 * @return array
 * @throws SocketException When mail cannot be sent.
 */
	public function send(CakeEmail $email) {
		$ses = SesClient::factory(array(
			'key' => $this->_config['Amazon.SES.Key'],
			'secret' => $this->_config['Amazon.SES.Secret'],
			'region' => $this->_config['Amazon.SES.Region']
		));

		$eol = PHP_EOL;
		if (isset($this->_config['eol'])) {
			$eol = $this->_config['eol'];
		}
		$headers = $this->_headersToString($email->getHeaders(array('from', 'sender', 'replyTo', 'readReceipt', 'returnPath', 'to', 'cc', 'subject')));
		$message = implode($eol, (array)$email->message());
		$rawMessage = $headers . $eol . $eol . $message;
		$res = $ses->sendRawEmail(array('RawMessage' => array('Data' => base64_encode($rawMessage) )));
		$results = $res->toArray();
		if (!$res) {
			throw new SocketException(__d('cake_dev', 'Could not send email.'));
		}
		return array('headers' => $headers, 'messageId' => $results['MessageId'], 'message' => $message);
	}
}
