<?php
declare(strict_types=1);

namespace Comgate;

use Comgate\Request\RequestInterface;
use Comgate\Response\CreatePaymentResponse;

class Client {

  private \GuzzleHttp\Client $client;


  /**
   * @param bool $test (use test env)
   * @param string|null $secret (if not set you cannot create transaction in
   *   background)
   */
  public function __construct(private string $merchantId, private bool $test = FALSE, private ?string $secret = NULL) {
    $this->client = new \GuzzleHttp\Client([
      'base_uri' => 'https://payments.comgate.cz/v1.0/',
    ]);
  }


  /**
   * @return $this
   */
  public function setClient(\GuzzleHttp\Client $client) {
    $this->client = $client;

    return $this;
  }


  /**
   * @return CreatePaymentResponse
   */
  public function send(RequestInterface $request) {
    $baseParams = $this->getBaseParams();

    if ($request->isPost()) {
      $response = $this->client->request('POST', $request->getEndPoint(), [
        'form_params' => $baseParams + $request->getData(),
      ]);
    }
    else {
      $response = $this->client->request('GET', $request->getEndPoint(), [
        'query' => $baseParams + $request->getData(),
      ]);
    }

    $body = (string) $response->getBody();
    if ($request->needParse()) {
      parse_str($body, $data);
    }
    else {
      $data = $body;
    }

    $responseClass = $request->getResponseClass();

    return new $responseClass($data);
  }

  public function getBaseParams(): array {
    return [
      'merchant' => $this->merchantId,
      'test' => $this->test ? 'true' : 'false',
      'secret' => $this->secret,
    ];
  }

}